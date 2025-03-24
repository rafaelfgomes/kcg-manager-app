<?php

declare(strict_types=1);

namespace Database\Migrations;

use App\DTO\Admin\AdminDTO;
use App\Support\Hash;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250323150025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Seed basic data on database';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $adminData = require rootPath() . '/resources/admin.php';

        $adminData['password'] = Hash::make($adminData['password']);

        $this->addSql('
            INSERT INTO admins
            (name, email, password, created_at)
            VALUES
            (:name, :email, :password, :created_at)
        ', $adminData);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

        $this->addSql('TRUNCATE TABLE admins');
    }
}
