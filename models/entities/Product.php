<?php

namespace app\models\entities;

use app\models\Entity;

class Product extends Entity
{
    protected int $id;
    protected string $name;
    protected float $actualPrice;
    protected float $oldPrice;
    protected string $address;
    protected string $description;
    protected string $corner;
    protected string $category;

    protected $props = [
        'name' => false,
        'actualPrice' => false,
        'oldPrice' => false,
        'address' => false,
        'description' => false,
        'corner' => false,
        'category' => false,
    ];

    public function __construct(
        $name = 'null',
        $actualPrice = 0.0,
        $oldPrice = 0.0,
        $address = 'null',
        $description = 'null',
        $corner = 'null',
        $category = 'null'
    ) {
        $this->name = $name;
        $this->actualPrice = $actualPrice;
        $this->oldPrice = $oldPrice;
        $this->address = $address;
        $this->description = $description;
        $this->corner = $corner;
        $this->category = $category;
    }
}
