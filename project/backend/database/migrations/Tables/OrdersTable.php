<?php

declare(strict_types=1);

namespace Database\Migrations\Tables;

use Doctrine\DBAL\Schema\Schema;

class OrdersTable extends AbstractTable
{
    private const TABLE_NAME = 'orders';

    public function __construct(Schema $schema)
    {
        parent::__construct($schema, self::TABLE_NAME);
    }

    public function __destruct() {}

    public function create(): void
    {
        # Add columns here
        $this
            ->addNewColumn('total_price', 'decimal', ['precision' => 8, 'scale' => 2])
            ->addNewColumn('paid_at', 'datetime');

        $this->addCreatedAtColumn();

        $this->addUpdatedAtColumn();

        # Add constraints here
        $this->table->setPrimaryKey(['id'], 'pk_orders');
    }
}