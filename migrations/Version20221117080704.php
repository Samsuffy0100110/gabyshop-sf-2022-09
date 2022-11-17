<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221117080704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_details ADD primary_offer_name VARCHAR(255) DEFAULT NULL, ADD primary_offer_reduce INT DEFAULT NULL, ADD primary_offer_type_reduce VARCHAR(255) DEFAULT NULL, ADD secondary_offer_name VARCHAR(255) DEFAULT NULL, ADD secondary_offer_reduce INT DEFAULT NULL, ADD secondary_offer_type_reduce VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_details DROP primary_offer_name, DROP primary_offer_reduce, DROP primary_offer_type_reduce, DROP secondary_offer_name, DROP secondary_offer_reduce, DROP secondary_offer_type_reduce');
    }
}
