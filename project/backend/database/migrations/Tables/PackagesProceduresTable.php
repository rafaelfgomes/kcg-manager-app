<?php

declare(strict_types=1);

namespace Database\Migrations\Tables;

use Doctrine\DBAL\Schema\Schema;

class PackagesProceduresTable extends AbstractPivotTable
{
    private const TABLE_NAME = 'packages_procedures';

    public function __construct(Schema $schema)
    {
        parent::__construct($schema, self::TABLE_NAME);
    }

    public function __destruct() {}

    public function create(): void
    {
        # Add columns here
        $this
            ->addNewColumn('package_id', 'bigint')
            ->addNewColumn('procedure_id', 'bigint');

        # Add constraints here
        $this->table->addForeignKeyConstraint('packages', ['package_id'], ['id'], [], 'fk_package');
        $this->table->addForeignKeyConstraint('procedures', ['procedure_id'], ['id'], [], 'fk_procedure');
    }
}