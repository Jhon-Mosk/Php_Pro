<?php

namespace app\models\repositories;

use app\engine\App;
use app\engine\Auth;
use app\models\entities\Order;
use app\models\Repository;

class OrderRepository extends Repository
{
    public function getTableName()
    {
        return 'orders';
    }

    protected function getEntityClass()
    {
        return Order::class;
    }

    public function getOrdersByStatus($status)
    {
        $sql = "SELECT * FROM `orders`, `carts`, `products` WHERE `status` = :status AND orders.session_id = carts.session_id AND carts.product_id = products.id ORDER BY `date` DESC";

        $orders = App::call()->db->queryAll($sql, ['status' => $status]);

        return $this->sortOrdersBy('session_id', $orders);
    }

    public function getUserOrders($login)
    {
        $sql = "SELECT * FROM `orders`, `carts`, `products` WHERE orders.session_id = carts.session_id AND carts.product_id = products.id AND orders.login = '{$login}' ORDER BY `date` DESC";

        $orders = App::call()->db->queryAll($sql);

        return $this->sortOrdersBy('session_id', $orders);
    }

    public function getAllOrders()
    {
        $sql = "SELECT * FROM `orders`, `carts`, `products` WHERE orders.session_id = carts.session_id AND carts.product_id = products.id ORDER BY `date` DESC";

        $orders = App::call()->db->queryAll($sql);

        return $this->sortOrdersBy('session_id', $orders);
    }

    protected function sortOrdersBy($attribute, $orders)
    {
        $currentOrder = $orders[0][$attribute];
        $result = [];

        foreach ($orders as $order) {
            if ($order[$attribute] === $currentOrder) {
                $result[$currentOrder][] = $order;
            } else {
                $currentOrder = $order[$attribute];
                $result[$currentOrder][] = $order;
            }
        }

        return $result;
    }

    public function order()
    {
        $tableName = $this->getTableName();
        $user_login = Auth::getUserLogin();
        $phone = App::call()->request->params['phone'];
        $session_id = App::call()->session->sessionId;
        $now = date("Y-m-d H:i:s");
        $sql = "INSERT INTO {$tableName}(`login`, `phone`, `session_id`, `date`, `status`) VALUES ('{$user_login}',:phone,'{$session_id}', '{$now}', 'await')";

        return App::call()->db->execute($sql, ['phone' => $phone]);
    }

    public function changeStatus($newStatus, $session_id)
    {
        $tableName = $this->getTableName();

        $sql = "UPDATE {$tableName} SET `status` = :newStatus WHERE `session_id` = :session_id";

        return App::call()->db->execute($sql, ['newStatus' => $newStatus, 'session_id' => $session_id]);
    }
}
