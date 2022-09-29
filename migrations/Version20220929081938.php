<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929081938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer 
        ADD started_at DATETIME DEFAULT NULL, 
        ADD ended_at DATETIME DEFAULT NULL, 
        ADD type_reduce VARCHAR(255) DEFAULT NULL, DROP percent');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer 
        ADD percent INT DEFAULT NULL, 
        DROP started_at, DROP ended_at, DROP type_reduce');
    }
}
