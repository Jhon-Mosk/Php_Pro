<?php

namespace app\controllers;

use app\engine\App;
use app\engine\Auth;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $login = App::call()->request->params['login'];
        $pass = App::call()->request->params['pass'];

        Auth::doLoginAction($login, $pass);

        header("Location: /");
        die();
    }

    public function actionLogout()
    {
        App::call()->session->destroy();
        setcookie("hash");
        header("Location: /");
        die();
    }
}
