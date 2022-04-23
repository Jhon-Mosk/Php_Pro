<?php

namespace app\controllers;

use app\engine\App;
use app\interfaces\IRender;
use app\engine\Auth;

abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    private $render;

    public function __construct(IRender $render)
    {
        $this->render = $render;
    }

    public function runAction($action)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = 'action' . ucfirst($this->action);

        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo '404 нет такого экшена';
        }
    }

    public function render($template, $params = [])
    {
        $user_login = Auth::getUserLogin();
        $session_id = App::call()->session->sessionId;

        return $this->renderTemplate('layouts/main', [
            'auth' => $this->renderTemplate('auth', [
                'allow' => Auth::is_auth(),
                'user_login' => $user_login
            ]),
            'menu' => $this->renderTemplate('menu', [
                'count' => App::call()->cartRepository->getCountWhere('session_id', $session_id),
                'role' => App::call()->session->params['role'],
                $params
            ]),
            'content' => $this->renderTemplate($template, $params)
        ]);
    }

    public function renderTemplate($template, $params = [])
    {
        return $this->render->renderTemplate($template, $params);
    }
}
