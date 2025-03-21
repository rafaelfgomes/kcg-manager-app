<?php

declare(strict_types=1);

namespace Database\Migrations;

use Database\Migrations\Files\AdminsTable;
use Database\Migrations\Files\CustomersTable;
use Database\Migrations\Files\PhonesTable;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250321164749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration to create the basic database structure';
    }

    public function up(Schema $schema): void
    {
        CustomersTable::create($schema);

        AdminsTable::create($schema);

        PhonesTable::create($schema);
    }

    public function down(Schema $schema): void
    {
        PhonesTable::drop($schema);

        CustomersTable::drop($schema);

        AdminsTable::drop($schema);
    }
}
