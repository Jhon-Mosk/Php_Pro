<?php

namespace app\engine;

class Session
{
    protected $params = [];
    protected $sessionId;

    public function __construct()
    {
        $this->start();
        $this->parseSession();
    }

    public function __get($name)
    {
        return $this->$name;
    }

    protected function parseSession()
    {
        $this->params = $_SESSION;
        $this->sessionId = session_id();
    }

    public function setParam($name, $value)
    {
        $this->params[$name] = $value;
    }

    private function start()
    {
        session_start();
    }

    public function regenerate()
    {
        session_regenerate_id();
    }

    public function destroy()
    {
        $this->regenerate();
        session_destroy();
    }
}
