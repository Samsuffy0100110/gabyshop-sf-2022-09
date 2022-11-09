<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109153857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP phone');
        $this->addSql('ALTER TABLE shipping DROP FOREIGN KEY FK_2D1C17248486F9AC');
        $this->addSql('DROP INDEX IDX_2D1C17248486F9AC ON shipping');
        $this->addSql('ALTER TABLE shipping DROP adress_id');
        $this->addSql('ALTER TABLE user ADD phone VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address ADD phone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE shipping ADD adress_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shipping ADD CONSTRAINT FK_2D1C17248486F9AC FOREIGN KEY (adress_id) REFERENCES address (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2D1C17248486F9AC ON shipping (adress_id)');
        $this->addSql('ALTER TABLE user DROP phone');
    }
}
