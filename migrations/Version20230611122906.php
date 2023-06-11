<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230611122906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create address_activity table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
        CREATE TABLE `address_activity` (
            `id` INT AUTO_INCREMENT NOT NULL,
            `address` VARCHAR(255) NOT NULL,
            `requested_at` VARCHAR(50) NOT NULL,
            PRIMARY KEY(`id`)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `address_activity`');
    }
}
