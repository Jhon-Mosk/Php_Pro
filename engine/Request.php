<?php

namespace app\engine;

class Request
{
    protected $requestString;
    protected $controllerName;
    protected $actionName;
    protected $method;
    protected $params = [];
    protected $inputPHP = [];

    public function __construct()
    {
        $this->parseRequest();
    }

    public function __get($name)
    {
        return $this->$name;
    }

    protected function parseRequest()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];

        $url = explode('/', $this->requestString);

        $this->controllerName = $url[1];
        $this->actionName = $url[2];

        $this->params = $_REQUEST;
        $inputPHP = json_decode(file_get_contents('php://input'));

        if (!is_null($inputPHP)) {
            foreach ($inputPHP as $key => $value) {
                $this->inputPHP[$key] = $value;
            }
        }
    }
}
