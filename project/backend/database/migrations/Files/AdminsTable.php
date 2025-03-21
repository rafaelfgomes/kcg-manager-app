<?php

declare(strict_types=1);

namespace Database\Migrations\Files;

use Doctrine\DBAL\Schema\Schema;

class AdminsTable
{
    private const TABLE_NAME = 'admins';

    public static function create(Schema $schema): void
    {
        $table = $schema->createTable(self::TABLE_NAME);

        $table->addColumn('id', 'bigint', ['autoincrement' => true]);
        
        $table->addColumn('name', 'string', ['length' => 50]);
        
        $table->addColumn('email', 'string', ['length' => 50]);
        
        $table->addColumn('password', 'string', ['length' => 150]);
        
        $table->addColumn('created_at', 'datetime');
        
        $table->addColumn('updated_at', 'datetime', ['notnull' => false]);
        
        $table->addColumn('deleted_at', 'datetime', ['notnull' => false]);
        
        $table->setPrimaryKey(['id'], 'pk_admins');
        
        $table->addUniqueIndex(['email'], 'uk_admin_email');
    }

    public static function drop(Schema $schema): void
    {
        $schema->dropTable(self::TABLE_NAME);
    }
}
