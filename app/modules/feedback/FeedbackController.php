<?php


namespace Modules\Feedback;

use Modules\Feedback\Models;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Router\Group as RouterGroup;
use Phalcon\Filter;


class FeedbackController extends Controller
{
    private $response = ['data' => null, 'error' => null];

    public function getRoutes()
    {
        $routes = new RouterGroup(array(
            'namespace' => 'Modules\Feedback',
            'controller' => 'Feedback'
        ));

        $routes->add(
            '/feedback/:action', [ 'action' => 1 ]
        );

        return $routes;
    }

    public function sendAction()
    {
        // getting $_POST data
        $feedback = json_decode($this->request->get('feedback'));

        // filter for validating POST data
        $filter = new Filter();

        // rule for validating phone number
        $filter->add('phone', function($value) {
            // remove all characters except of digits
            return preg_replace('/[^0-9]/', '', $value);
        });
        // rule for validating text
        $filter->add('text', function($value) {
            // Strip tags and encode all HTML entities, but remain single and double quotes
            $value = strip_tags($value);
            $value = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            $value = filter_var($value, FILTER_SANITIZE_STRING, ['flags' => FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_BACKTICK]);
            return $value;
        });

        $name = $filter->sanitize($feedback->name, ['text', 'trim']); // validating $_POST data, applying 'strip_tags', 'htmlspecialchars' and 'trim' functions, remaining single and double quotes
        $phone = $filter->sanitize($feedback->phone, 'phone');// validating $_POST data with custom 'phone' filter
        $messageText = $filter->sanitize($feedback->message, 'text');

        $message = new Models\Message();
        $message->name = $name;
        $message->phone = $phone;
        $message->text = $messageText;

        $resp = array_slice($this->response, 0);
        $resp['data'] = [];

        $resp['data']['file'] = $message->saveIn('file');
        $resp['data']['db_default'] = $message->saveIn('db');

        if (!$resp['data']['file'] || $messages = $message->getMessages()) {
            $resp['error'] = [];

            $errors = array_reduce($messages, function($carry, $message) {
                $carry[] = $message->getMessage();
                return $carry;
            }, []);
            $resp['error'] = $errors;

            if (!$resp['data']['file'])
                $resp['error'][] = 'Error saving in file';
        }

        echo json_encode($resp);
    }
}