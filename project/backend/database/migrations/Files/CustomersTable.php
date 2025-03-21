<?php

declare(strict_types=1);

namespace Database\Migrations\Files;

use Doctrine\DBAL\Schema\Schema;

class CustomersTable
{
    private const TABLE_NAME = 'customers';

    public static function create(Schema $schema): void
    {
        $table = $schema->createTable(self::TABLE_NAME);

        $table->addColumn('id', 'bigint', ['autoincrement' => true]);
        
        $table->addColumn('name', 'string', ['length' => 50]);
        
        $table->addColumn('email', 'string', ['length' => 50]);
        
        $table->addColumn('created_at', 'datetime');
        
        $table->addColumn('updated_at', 'datetime', ['notnull' => false]);
        
        $table->addColumn('deleted_at', 'datetime', ['notnull' => false]);
        
        $table->setPrimaryKey(['id'], 'pk_customers');
        
        $table->addUniqueIndex(['email'], 'uk_customer_email');
    }

    public static function drop(Schema $schema): void
    {
        $schema->dropTable(self::TABLE_NAME);
    }
}
