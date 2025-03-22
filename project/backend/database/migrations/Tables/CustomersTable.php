<?php

declare(strict_types=1);

namespace Database\Migrations\Tables;

use Doctrine\DBAL\Schema\Schema;

class CustomersTable extends AbstractTable
{
    private const TABLE_NAME = 'customers';

    public function __construct(Schema $schema)
    {
        parent::__construct($schema, self::TABLE_NAME);
    }

    public function __destruct() {}

    public function create(): void
    {
        $this
            ->addNewColumn('name', 'string', ['length' => 50])
            ->addNewColumn('email', 'string', ['length' => 50]);
        
        $this->addAllTimestampsColumns();
        
        $this->table->setPrimaryKey(['id'], 'pk_customers');
        
        $this->table->addUniqueIndex(['email'], 'uk_customer_email');
    }
}
