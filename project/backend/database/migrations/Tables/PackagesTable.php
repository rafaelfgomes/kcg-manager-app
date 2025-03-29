<?php

declare(strict_types=1);

namespace Database\Migrations\Tables;

use Doctrine\DBAL\Schema\Schema;

class PackagesTable extends AbstractTable
{
    private const TABLE_NAME = 'packages';

    public function __construct(Schema $schema)
    {
        parent::__construct($schema, self::TABLE_NAME);
    }

    public function __destruct() {}

    public function create(): void
    {
        # Add columns here
        $this
            ->addNewColumn('name', 'string', ['length' => 50])
            ->addNewColumn('sessions', 'integer')
            ->addNewColumn('price', 'decimal', ['precision' => 8, 'scale' => 2]);

        $this->addAllTimestampsColumns();

        # Add constraints here
        $this->table->setPrimaryKey(['id'], 'pk_packages');
    }
}