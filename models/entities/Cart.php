<?php

namespace app\models\entities;

use app\models\Entity;

class Cart extends Entity
{
    protected int $id;
    protected int $product_id;
    protected string $session_id;
    protected string $login;
    protected float $price;
    protected string $uniqId;

    protected $props = [
        'product_id' => false,
        'session_id' => false,
        'login' => false,
        'price' => false,
        'uniqId' => false
    ];

    public function __construct(
        $product_id = 0,
        $session_id = 'null',
        $login = 'null',
        $price = 0.0,
        $uniqId = 'null'
    ) {
        $this->product_id = $product_id;
        $this->session_id = $session_id;
        $this->login = $login;
        $this->price = $price;
        $this->uniqId = $uniqId;
    }
}
