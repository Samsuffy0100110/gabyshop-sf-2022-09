<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221107154536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE custom ADD custom_order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE custom ADD CONSTRAINT FK_F584169B684D8A5C FOREIGN KEY (custom_order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_F584169B684D8A5C ON custom (custom_order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE custom DROP FOREIGN KEY FK_F584169B684D8A5C');
        $this->addSql('DROP INDEX IDX_F584169B684D8A5C ON custom');
        $this->addSql('ALTER TABLE custom DROP custom_order_id');
    }
}
