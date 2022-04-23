<?php

namespace app\models\entities;

use app\models\Entity;

class User extends Entity
{
    protected int $id;
    protected string $login;
    protected string $pass;
    protected string $hash;
    protected int $role;

    protected $props = [
        'login' => false,
        'pass' => false,
        'hash' => false,
        'role' => false,
    ];

    public function __construct(
        $login = 'null',
        $pass = 'null',
        $hash = 'null',
        $role = 0
    ) {
        $this->login = $login;
        $this->pass = $pass;
        $this->hash = $hash;
        $this->role = $role;
    }
}
