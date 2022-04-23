<?php

namespace app\controllers;

use app\engine\App;
use app\engine\Auth;

class OrderController extends Controller
{
    public function actionIndex()
    {
        $user_login = Auth::getUserLogin();
        $allow = Auth::is_auth();

        if ($user_login !== 'anonymous') {
            $orders = App::call()->orderRepository->getUserOrders($user_login);
        }

        echo $this->render('order/orders', [
            'orders' => $orders,
            'allow' => $allow,
        ]);
    }

    public function actionBuy()
    {
        echo $this->render('order/orderForm');
    }

    public function actionOrder()
    {
        App::call()->orderRepository->order();

        session_regenerate_id();
        header("Location: /product/catalog");
        die();
    }

    public function actionOrdersManagement()
    {
        echo $this->render('order/ordersManagement');
    }

    public function actionGetOrders()
    {
        $ordersType = App::call()->request->inputPHP['ordersType'];
        $status = 'ok';

        if ($ordersType === 'allOrders') {
            $orders = App::call()->orderRepository->getAllOrders();
        } else {
            $orders = App::call()->orderRepository->getOrdersByStatus($ordersType);
        }

        if (!$orders) {
            $status = 'error';
        }

        $response = [
            'status' => $status,
            'orders' => $orders,
        ];

        header('content-type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();
    }

    public function actionChangeStatus()
    {
        $newStatus = App::call()->request->inputPHP['newStatus'];
        $session_id = App::call()->request->inputPHP['session_id'];
        $status = 'ok';

        if (App::call()->orderRepository->changeStatus($newStatus, $session_id)) {
            $status = 'ok';
        } else {
            $status = 'error';
        }

        $response = [
            'status' => $status,
        ];

        header('content-type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();
    }
}
