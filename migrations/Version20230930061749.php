<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230930061749 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Table [purchases]: created';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE `purchases` (
            `id` VARCHAR(255) NOT NULL, 
            `status` TEXT NOT NULL, 
            `name` VARCHAR(255) NOT NULL, 
            `quantity` INT NOT NULL, 
            `created_at` DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', 
            `updated_at` DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', 
            PRIMARY KEY(`id`)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `purchases`');
    }
}
