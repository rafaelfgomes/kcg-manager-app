<?php

namespace Database\Migrations\Tables;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

abstract class AbstractTable
{
    protected Table $table;

    public function __construct(
        protected Schema $schema,
        protected string $tableName
    ) {
        if (! $this->schema->hasTable($tableName)) {
            $this->table = $this->schema->createTable($tableName);
        }
        
        $this->table->addColumn('id', 'bigint', ['autoincrement' => true]); 
    }

    abstract public function create(): void;

    public function addNewColumn(string $columnName, $columnType, array $options = []): self
    {
        $this->table->addColumn($columnName, $columnType, $options);

        return $this;
    }

    public function addAllTimestampsColumns(): self
    {
        $this->table->addColumn('created_at', 'datetime');

        $this->table->addColumn('updated_at', 'datetime', ['notnull' => false]);

        $this->table->addColumn('deleted_at', 'datetime', ['notnull' => false]);

        return $this;
    }

    public function addCreatedAtColumn(): self
    {
        $this->table->addColumn('created_at', 'datetime');

        return $this;
    }

    public function addUpdatedAtColumn(): self
    {
        $this->table->addColumn('updated_at', 'datetime', ['notnull' => false]);

        return $this;
    }

    public function addDeletedAtColumn(): self
    {
        $this->table->addColumn('deleted_at', 'datetime', ['notnull' => false]);

        return $this;
    }

    public function drop(): void
    {
        $this->schema->dropTable($this->table->getName());
    }
}