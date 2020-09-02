<?php


namespace Modules\Feedback;

use Controllers\ControllerBase;
use Modules\Feedback\Models;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Router\Group as RouterGroup;
use Phalcon\Filter;


class FeedbackController extends ControllerBase
{
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

        $this->response['data'] = [];

        $this->response['data']['file'] = $message->saveIn('file');
        $this->response['data']['db_default'] = $message->saveIn('db');

        if (!$this->response['data']['file'] || $messages = $message->getMessages()) {
            $this->response['error'] = [];

            $errors = array_reduce($messages, function($carry, $message) {
                $carry[] = $message->getMessage();
                return $carry;
            }, []);
            $this->response['error'] = $errors;

            if (!$this->response['data']['file'])
                $this->response['error'][] = 'Error saving in file';
        }

        $this->json();
    }
}