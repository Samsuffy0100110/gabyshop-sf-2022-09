<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221124152109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE custom DROP FOREIGN KEY FK_F584169B51383AF3');
        $this->addSql('DROP INDEX IDX_F584169B51383AF3 ON custom');
        $this->addSql('ALTER TABLE custom ADD attribut VARCHAR(255) DEFAULT NULL, DROP attribut_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE custom ADD attribut_id INT DEFAULT NULL, DROP attribut');
        $this->addSql('ALTER TABLE custom ADD CONSTRAINT FK_F584169B51383AF3 FOREIGN KEY (attribut_id) REFERENCES attribut (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F584169B51383AF3 ON custom (attribut_id)');
    }
}
