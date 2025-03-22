<?php

declare(strict_types=1);

namespace Database\Migrations\Tables;

use Doctrine\DBAL\Schema\Schema;

class PhonesTable extends AbstractTable
{
    private const TABLE_NAME = 'phones';

    public function __construct(Schema $schema)
    {
        parent::__construct($schema, self::TABLE_NAME);
    }

    public function __destruct() {}

    public function create(): void
    {
        $this
            ->addNewColumn('country', 'integer')
            ->addNewColumn('code', 'integer')
            ->addNewColumn('number', 'string', ['length' => 9])
            ->addNewColumn('customer_id', 'bigint');
        
        $this->addAllTimestampsColumns();
        
        $this->table->setPrimaryKey(['id'], 'pk_phones');
        
        $this->table->addForeignKeyConstraint('customers', ['customer_id'], ['id'], [], 'fk_customer_phone');
    }
}
