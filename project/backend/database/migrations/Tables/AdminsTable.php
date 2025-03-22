<?php

declare(strict_types=1);

namespace Database\Migrations\Tables;

use Doctrine\DBAL\Schema\Schema;

class AdminsTable extends AbstractTable
{
    private const TABLE_NAME = 'admins';

    public function __construct(Schema $schema)
    {
        parent::__construct($schema, self::TABLE_NAME);
    }

    public function __destruct() {}

    public function create(): void
    {        
        $this
            ->addNewColumn('name', 'string', ['length' => 50])
            ->addNewColumn('email', 'string', ['length' => 50])
            ->addNewColumn('password', 'string', ['length' => 150]);

        $this->addAllTimestampsColumns();
        
        $this->table->setPrimaryKey(['id'], 'pk_admins');
        
        $this->table->addUniqueIndex(['email'], 'uk_admin_email');
    }
}
