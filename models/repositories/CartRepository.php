<?php

namespace app\models\repositories;

use app\engine\App;
use app\models\entities\Cart;
use app\models\Repository;

class CartRepository extends Repository
{
    protected function getTableName()
    {
        return 'carts';
    }

    protected function getEntityClass()
    {
        return Cart::class;
    }

    public function getSumCart()
    {
        $tableName = $this->getTableName();
        $session_id = App::call()->session->sessionId;
        $sql = "SELECT SUM(`price`) as total FROM {$tableName} WHERE `session_id` = :session_id";

        $result = (App::call()->db->queryOne($sql, ['session_id' => $session_id]))['total'] ?? 0;

        return $result ? $result : 0;
    }

    public function getCart()
    {
        $tableName = $this->getTableName();
        $session_id = App::call()->session->sessionId;
        $sql = "SELECT * FROM {$tableName} JOIN products ON (carts.product_id = products.id) WHERE `session_id` = :session_id";

        return App::call()->db->queryAll($sql, ['session_id' => $session_id]);
    }
}
