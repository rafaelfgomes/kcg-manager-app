<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250320210248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE IF NOT EXISTS customers (
                id BIGINT NOT NULL AUTO_INCREMENT,
                name VARCHAR(50) NOT NULL,
                email VARCHAR(50) NOT NULL,
                created_at DATETIME NOT NULL,
                updated_at DATETIME,
                deleted_at DATETIME,
                CONSTRAINT PK_USERS PRIMARY KEY (id),
                CONSTRAINT UK_CUSTOMER_EMAIL UNIQUE (email)
            )'
        );

        $this->addSql(
            'CREATE TABLE IF NOT EXISTS admins (
                id BIGINT NOT NULL AUTO_INCREMENT,
                name VARCHAR(50) NOT NULL,
                email VARCHAR(50) NOT NULL,
	            `password` VARCHAR(150) NOT NULL,
	            created_at DATETIME NOT NULL,
	            updated_at DATETIME,
	            deleted_at DATETIME,
	            CONSTRAINT PK_ADMINS PRIMARY KEY (id),
	            CONSTRAINT UK_ADMIN_EMAIL UNIQUE (email)
            )'
        );

        $this->addSql(
            'CREATE TABLE IF NOT EXISTS phones (
                id BIGINT NOT NULL AUTO_INCREMENT,
                country INT NOT NULL,
                code INT,
                `number` VARCHAR(9) NOT NULL,
                customer_id BIGINT NOT NULL,
                created_at DATETIME NOT NULL,
                updated_at DATETIME,
                deleted_at DATETIME,
                CONSTRAINT PK_PHONES PRIMARY KEY (id),
                CONSTRAINT FK_CUSTOMER_PHONE FOREIGN KEY (customer_id) REFERENCES customers (id)
            )'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $schema->dropTable('phones');

        $schema->dropTable('admins');

        $schema->dropTable('customers');
    }
}
