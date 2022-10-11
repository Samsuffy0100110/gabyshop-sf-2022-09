<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221011072905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_details (
            id INT AUTO_INCREMENT NOT NULL, 
            my_order_id INT DEFAULT NULL, 
            product VARCHAR(255) DEFAULT NULL, 
            quantity INT DEFAULT NULL, 
            price DOUBLE PRECISION DEFAULT NULL, 
            total DOUBLE PRECISION DEFAULT NULL, 
            INDEX IDX_845CA2C1BFCDF877 (my_order_id), 
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 
            COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_details 
        ADD CONSTRAINT FK_845CA2C1BFCDF877 
        FOREIGN KEY (my_order_id) REFERENCES `order` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_details DROP FOREIGN KEY FK_845CA2C1BFCDF877');
        $this->addSql('DROP TABLE order_details');
    }
}
