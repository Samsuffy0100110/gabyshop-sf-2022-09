<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926133232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE option_parent (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `option` ADD option_parent_id INT DEFAULT NULL, ADD position INT DEFAULT NULL, ADD is_active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B0A3E1DAF0 FOREIGN KEY (option_parent_id) REFERENCES option_parent (id)');
        $this->addSql('CREATE INDEX IDX_5A8600B0A3E1DAF0 ON `option` (option_parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B0A3E1DAF0');
        $this->addSql('DROP TABLE option_parent');
        $this->addSql('DROP INDEX IDX_5A8600B0A3E1DAF0 ON `option`');
        $this->addSql('ALTER TABLE `option` DROP option_parent_id, DROP position, DROP is_active');
    }
}
