<?php

declare(strict_types=1);

namespace Database\Migrations\Files;

use Doctrine\DBAL\Schema\Schema;

class PhonesTable
{
    private const TABLE_NAME = 'phones';

    public static function create(Schema $schema): void
    {
        $table = $schema->createTable(self::TABLE_NAME);

        $table->addColumn('id', 'bigint', ['autoincrement' => true]);
        
        $table->addColumn('country', 'integer');
        
        $table->addColumn('code', 'integer');
        
        $table->addColumn('number', 'string', ['length' => 9]);

        $table->addColumn('customer_id', 'bigint');
        
        $table->addColumn('created_at', 'datetime');
        
        $table->addColumn('updated_at', 'datetime', ['notnull' => false]);
        
        $table->addColumn('deleted_at', 'datetime', ['notnull' => false]);
        
        $table->setPrimaryKey(['id'], 'pk_phones');
        
        $table->addForeignKeyConstraint('customers', ['customer_id'], ['id'], [], 'fk_customer_phone');
    }

    public static function drop(Schema $schema): void
    {
        $schema->dropTable(self::TABLE_NAME);
    }
}
