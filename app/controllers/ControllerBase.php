<?php


namespace Controllers;

use Phalcon\Mvc\Controller;


class ControllerBase extends Controller
{
    protected $response = ['data' => null, 'error' => null];

    function clearResponse() {
        $this->response = ['data' => null, 'error' => null];
    }

    public function json() {
        echo json_encode($this->response);
        $this->clearResponse();
        die;
    }

    public function getRoutes() {}
}