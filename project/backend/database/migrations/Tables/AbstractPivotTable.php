<?php

namespace Database\Migrations\Tables;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

abstract class AbstractPivotTable
{
    protected Table $table;

    public function __construct(
        protected Schema $schema,
        protected string $tableName
    ) {
        $this->table = $this->schema->createTable($tableName);

        $this->table->addColumn('id', 'bigint', ['autoincrement' => true]);
    }

    abstract public function create(): void;

    public function addNewColumn(string $columnName, $columnType, array $options = []): self
    {
        $this->table->addColumn($columnName, $columnType, $options);

        return $this;
    }

    public function drop(): void
    {
        $this->schema->dropTable($this->table->getName());
    }
}