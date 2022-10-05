<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005075718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shipping 
        (id INT AUTO_INCREMENT NOT NULL, 
        name VARCHAR(255) DEFAULT NULL, 
        description LONGTEXT DEFAULT NULL, 
        price DOUBLE PRECISION DEFAULT NULL, 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 
        COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE category 
        ADD CONSTRAINT FK_64C19C1727ACA70 
        FOREIGN KEY (parent_id) REFERENCES parent_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE shipping');
        $this->addSql('ALTER TABLE category 
        DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE category 
        ADD CONSTRAINT FK_64C19C1727ACA70 
        FOREIGN KEY (parent_id) 
        REFERENCES parent_category (id) 
        ON UPDATE NO ACTION ON DELETE SET NULL');
    }
}
