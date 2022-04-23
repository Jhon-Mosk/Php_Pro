<?php

namespace app\engine;

use app\models\entities\User;

class Auth
{
    public static function is_auth()
    {
        if (isset($_SESSION['login'])) {
            return true;
        }

        if (isset($_COOKIE["hash"])) {
            $hash = $_COOKIE["hash"];
            $user = App::call()->userRepository->getWhereOne('hash', $hash);
            $login = $user->login;
            if (!empty($login)) {
                $_SESSION['login'] = $login;
                App::call()->session->setParam('login', $login);
            }
        }

        return isset($_SESSION['login']);
    }

    public static function getUserLogin()
    {
        return App::call()->session->params['login'] ?? 'anonymous';
    }

    public static function doLoginAction($login, $pass)
    {
        if (isset(App::call()->request->params['reg'])) {
            $message = Auth::regUser($login, $pass);
            if ($message === 'reg_ok') {
                Auth::auth($login, $pass);
            }
        } elseif (isset(App::call()->request->params['auth'])) {
            if (Auth::auth($login, $pass)) {
                if (isset(App::call()->request->params['saveUser'])) {
                    $hash = uniqid(rand(), true);

                    $user = App::call()->userRepository->getWhereOne('id', App::call()->session->params['id']);
                    $user->hash = $hash;
                    App::call()->userRepository->save($user);

                    setcookie("hash", $hash, time() + 3600 * 24 * 7);
                }
            }
        }
    }

    public static function regUser($login, $pass)
    {
        if (!empty($login) && !empty($pass)) {
            if (Auth::checkLogin($login)) {
                $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

                $user = new User($login, $pass_hash);
                App::call()->userRepository->insert($user);

                return 'reg_ok';
            } else {
                return 'reg_repeat';
            }
        } else {
            return 'empty_input';
        }
    }

    public static function auth($login, $password)
    {

        $session = App::call()->session;
        $user = App::call()->userRepository->getWhereOne('login', $login);
        if (password_verify($password, $user->pass)) {
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $user->id;
            $_SESSION['role'] = $user->role;
            // App::call()->session->setParam('login', $login);
            // App::call()->session->setParam('id', $user->id);
            // App::call()->session->setParam('role', $user->role);
            $session->setParam('login', $login);
            $session->setParam('id', $user->id);
            $session->setParam('role', $user->role);

            return true;
        }
        return false;
    }

    public static function checkLogin($login)
    {
        $result = App::call()->userRepository->getWhereOne('login', $login, 'login');

        if ($result->login === $login) {
            return false;
        }

        return true;
    }
}
