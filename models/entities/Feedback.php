<?php

namespace app\models\entities;

use app\models\Entity;

class Feedback extends Entity
{
    protected int $id;
    protected string $name;
    protected string $feedback;
    protected int $id_product;

    protected $props = [
        'name' => false,
        'feedback' => false,
        'id_product' => false
    ];

    public function __construct(
        $name = 'null',
        $feedback = 'null',
        $id_product = 0
    ) {
        $this->name = $name;
        $this->feedback = $feedback;
        $this->id_product = $id_product;
    }
}
