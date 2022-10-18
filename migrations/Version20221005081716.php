<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005081716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` 
        (id INT AUTO_INCREMENT NOT NULL, 
        user_id INT DEFAULT NULL, 
        shipping_id INT DEFAULT NULL, 
        created_at DATETIME DEFAULT NULL, 
        reference VARCHAR(255) DEFAULT NULL, 
        state INT DEFAULT NULL, 
        INDEX IDX_F5299398A76ED395 (user_id), 
        UNIQUE INDEX UNIQ_F52993984887F3F8 (shipping_id), 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 
        COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` 
        ADD CONSTRAINT FK_F5299398A76ED395 
        FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` 
        ADD CONSTRAINT FK_F52993984887F3F8 
        FOREIGN KEY (shipping_id) REFERENCES shipping (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993984887F3F8');
        $this->addSql('DROP TABLE `order`');
    }
}