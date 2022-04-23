<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePhpProjectTables extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $this->table('carts')
            ->addColumn('product_id', 'int')
            ->addColumn('session_id', 'varchar(255)')
            ->addColumn('login', 'varchar(60)')
            ->addColumn('price', 'varchar(255)')
            ->addColumn('uniqId', 'varchar(255)')
            ->create();

        $this->table('feedbacks')
            ->addColumn('name', 'varchar(255)')
            ->addColumn('feedback', 'text')
            ->addColumn('id_product', 'int')
            ->create();

        $this->table('orders')
            ->addColumn('login', 'varchar(60)')
            ->addColumn('phone', 'varchar(20)')
            ->addColumn('session_id', 'varchar(255)')
            ->addColumn('date', 'datetime')
            ->addColumn('status', 'varchar(255)')
            ->create();

        $this->table('products')
            ->addColumn('name', 'varchar(255)')
            ->addColumn('actualPrice', 'varchar(255)')
            ->addColumn('oldPrice', 'varchar(255)')
            ->addColumn('address', 'varchar(255)')
            ->addColumn('description', 'text')
            ->addColumn('corner', 'varchar(255)')
            ->addColumn('category', 'varchar(255)')
            ->create();

        $this->table('users')
            ->addColumn('login', 'varchar(20)')
            ->addColumn('pass', 'varchar(255)')
            ->addColumn('hash', 'varchar(255)')
            ->addColumn('role', 'int')
            ->create();
    }
}
