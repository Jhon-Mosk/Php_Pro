<?php
// // Логин админа: admin
// // Пароль админа: 123
// // Логин пользователя: user
// // Пароль пользователя: 123

use app\engine\Db;
use app\engine\{Request, Session};
use app\models\repositories\{CartRepository, FeedbackRepository, OrderRepository, ProductRepository, UserRepository};

return [
    'root' => dirname(__DIR__),
    'controller_namespace' => 'app\\controllers\\',
    'views_dir' => dirname(__DIR__) . '/views/',
    'templates_dir' => dirname(__DIR__) . '/templates/',
    'product_per_page' => 2,
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost:3306',
            'login' => 'root',
            'pass' => '',
            'db' => 'php_2.0_project',
            'charset' => 'utf8',
        ],
        'request' => [
            'class' => Request::class,
        ],
        'session' => [
            'class' => Session::class,
        ],
        'cartRepository' => [
            'class' => CartRepository::class,
        ],
        'feedbackRepository' => [
            'class' => FeedbackRepository::class,
        ],
        'orderRepository' => [
            'class' => OrderRepository::class,
        ],
        'productRepository' => [
            'class' => ProductRepository::class,
        ],
        'userRepository' => [
            'class' => UserRepository::class,
        ],
    ]
];
