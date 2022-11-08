<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221108150735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE custom ADD attribut_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE custom ADD CONSTRAINT FK_F584169B51383AF3 FOREIGN KEY (attribut_id) REFERENCES attribut (id)');
        $this->addSql('CREATE INDEX IDX_F584169B51383AF3 ON custom (attribut_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE custom DROP FOREIGN KEY FK_F584169B51383AF3');
        $this->addSql('DROP INDEX IDX_F584169B51383AF3 ON custom');
        $this->addSql('ALTER TABLE custom DROP attribut_id');
    }
}
