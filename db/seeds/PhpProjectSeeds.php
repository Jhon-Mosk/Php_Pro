<?php


use Phinx\Seed\AbstractSeed;

class PhpProjectSeeds extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $sql = 'TRUNCATE carts';
        $this->adapter->query($sql);
        $sql = 'TRUNCATE feedbacks';
        $this->adapter->query($sql);
        $sql = 'TRUNCATE orders';
        $this->adapter->query($sql);
        $sql = 'TRUNCATE products';
        $this->adapter->query($sql);
        $sql = 'TRUNCATE users';
        $this->adapter->query($sql);

        $products = [
            [
                'name' => 'Single Thruster 2014',
                'actualPrice' => '865.00',
                'oldPrice' => '0',
                'address' => '/img/surfhouse/products/surf1.jpg',
                'description' => 'Single Thruster 2014',
                'corner' => 'productUnitNew',
                'category' => 'New products'
            ]
        ];
        $this->table('products')->insert($products)->save();

        $users = [
            [
                'login' => 'user',
                'pass' => '$2y$10$oqTxCcd.qLon0DjqWA62JOrT6mjiDaNFO.VDmy1XBxLhgeZ5jZ1G.',
                'hash' => '1876434325620cd4fd7cd5a9.50535768',
                'role' => 0,
            ],
            [
                'login' => 'admin',
                'pass' => '$2y$10$zg9Cb/so9sLwUGxrUZSuOe1rP/9A.cbo496z3ipTxfJU5gyRXHTAm',
                'hash' => '289408464623b7e62403ac4.63933666',
                'role' => 1,
            ]
        ];
        $this->table('users')->insert($users)->save();
    }
}
