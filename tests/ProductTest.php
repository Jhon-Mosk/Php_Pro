<?php

use app\models\entities\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    protected $fixture;

    protected function setUp(): void
    {
        $this->fixture = new Product();
    }

    public function testProductConstructor()
    {
        $params = [
            'name' => 'name',
            'actualPrice' => 200.50,
            'oldPrice' => 345.00,
            'address' => 'url',
            'description' => 'best',
            'corner' => 'hot',
            'category' => 'novelty',
        ];

        foreach ($params as $key => $value) {
            $this->fixture->$key = $value;
        }

        $this->assertEquals($params['name'], $this->fixture->name);
        $this->assertEquals($params['actualPrice'], $this->fixture->actualPrice);
        $this->assertEquals($params['oldPrice'], $this->fixture->oldPrice);
        $this->assertEquals($params['address'], $this->fixture->address);
        $this->assertEquals($params['description'], $this->fixture->description);
        $this->assertEquals($params['corner'], $this->fixture->corner);
        $this->assertEquals($params['category'], $this->fixture->category);
    }

    /**
     * @dataProvider productPropsProvider
     */

    public function testProductProps($a, $expected)
    {
        $this->assertEquals($expected, $a);
    }

    public function productPropsProvider()
    {
        $props = $this->product->props;

        return [
            [$props['name'], false],
            [$props['actualPrice'], false],
            [$props['oldPrice'], false],
            [$props['address'], false],
            [$props['description'], false],
            [$props['corner'], false],
            [$props['category'], false]
        ];
    }

    protected function tearDown(): void
    {
        $this->fixture = NULL;
    }
}
