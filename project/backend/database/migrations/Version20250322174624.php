<?php

declare(strict_types=1);

namespace Database\Migrations;

use Database\Migrations\Tables\AdminsTable;
use Database\Migrations\Tables\CustomersTable;
use Database\Migrations\Tables\PhonesTable;
use Database\Migrations\Tables\ProceduresTable;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250322174624 extends AbstractMigration
{
    private const TABLE_CREATE_SEQUENCE = [
        AdminsTable::class,
        CustomersTable::class,
        PhonesTable::class,
        ProceduresTable::class,
    ];

    public function getDescription(): string
    {
        return 'Create initial dabatase structure';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        foreach (self::TABLE_CREATE_SEQUENCE as $classTable) {
            $class = new $classTable($schema);

            call_user_func([$class, 'create']);

            unset($class);
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
