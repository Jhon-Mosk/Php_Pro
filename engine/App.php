<?php

namespace app\engine;

use app\traits\TSingelton;
use app\models\repositories\{CartRepository, FeedbackRepository, OrderRepository, ProductRepository, UserRepository};
use ReflectionClass;

/**
 * Class App
 * @property Session $session
 * @property Request $request
 * @property CartRepository $cartRepository
 * @property FeedbackRepository $feedbackRepository
 * @property OrderRepository $orderRepository
 * @property ProductRepository $productRepository
 * @property UserRepository $userRepository
 * @property Db $db
 */

class App
{
    use TSingelton;

    public $config;
    private $components;
    private $controller;
    private $action;

    private function runController()
    {
        $this->controller = $this->request->controllerName ?: 'product';
        $this->action = $this->request->actionName;

        $controllerClass = $this->config['controller_namespace'] . ucfirst($this->controller) . 'Controller';

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new Render);
            $controller->runAction($this->action);
        } else {
            echo '404 нет такого контроллера';
        }
    }

    /**
     * @return static
     */
    public static function call()
    {
        return static::getInstance();
    }

    public function run($config)
    {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    public function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];

            if (class_exists($class)) {
                unset($params['class']);

                $reflection = new ReflectionClass($class);

                return $reflection->newInstanceArgs($params);
            }
        }
        die("Компонента {$name} не существует в конфигурации системы!");
    }

    public function __get($name)
    {
        return $this->components->get($name);
    }
}
