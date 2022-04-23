<?php

namespace app\models\entities;

use app\models\Entity;

class Order extends Entity
{
    protected int $id;
    protected string $login;
    protected string $phone;
    protected string $session_id;
    protected string $date;
    protected string $status;

    protected $props = [
        'login' => false,
        'phone' => false,
        'session_id' => false,
        'date' => false,
        'status' => false,
    ];

    public function __construct(
        $login = 'null',
        $phone = 'null',
        $session_id = 'null',
        $date = 'null',
        $status = 'null'
    ) {
        $this->login = $login;
        $this->phone = $phone;
        $this->session_id = $session_id;
        $this->date = $date;
        $this->status = $status;
    }
}
