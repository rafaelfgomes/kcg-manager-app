<?php

declare(strict_types=1);

namespace Database\Migrations\Tables;

use Doctrine\DBAL\Schema\Schema;

class OrderItemsTable extends AbstractTable
{
    private const TABLE_NAME = 'order_items';

    public function __construct(Schema $schema)
    {
        parent::__construct($schema, self::TABLE_NAME);
    }

    public function __destruct() {}

    public function create(): void
    {
        # Add columns here
        $this
            ->addNewColumn('order_id', 'bidgit')
            ->addNewColumn('order_type', 'string', ['length' => 20])
            ->addNewColumn('procedure_package_id', 'bigint');

        $this->addAllTimestampsColumns();

        # Add constraints here
        $this->table->setPrimaryKey(['id'], 'pk_order_items');

        $this->table->addForeignKeyConstraint('orders', ['order_id'], ['id'], [], 'fk_orders');
    }
}