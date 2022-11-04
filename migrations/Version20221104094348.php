<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221104094348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD adress_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` 
        ADD CONSTRAINT FK_F52993988486F9AC 
        FOREIGN KEY (adress_id) 
        REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_F52993988486F9AC ON `order` (adress_id)');
        $this->addSql('ALTER TABLE order_details DROP FOREIGN KEY FK_845CA2C18486F9AC');
        $this->addSql('DROP INDEX IDX_845CA2C18486F9AC ON order_details');
        $this->addSql('ALTER TABLE order_details DROP adress_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993988486F9AC');
        $this->addSql('DROP INDEX IDX_F52993988486F9AC ON `order`');
        $this->addSql('ALTER TABLE `order` DROP adress_id');
        $this->addSql('ALTER TABLE order_details ADD adress_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_details 
        ADD CONSTRAINT FK_845CA2C18486F9AC 
        FOREIGN KEY (adress_id) 
        REFERENCES address (id) 
        ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_845CA2C18486F9AC ON order_details (adress_id)');
    }
}
