<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221121132007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribut DROP FOREIGN KEY FK_7AB8E85D8C0FA77');
        $this->addSql('DROP INDEX IDX_7AB8E85D8C0FA77 ON attribut');
        $this->addSql('ALTER TABLE attribut DROP order_details_id');
        $this->addSql('ALTER TABLE order_details ADD custom_price DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribut ADD order_details_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE attribut ADD CONSTRAINT FK_7AB8E85D8C0FA77 FOREIGN KEY (order_details_id) REFERENCES order_details (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7AB8E85D8C0FA77 ON attribut (order_details_id)');
        $this->addSql('ALTER TABLE order_details DROP custom_price');
    }
}
