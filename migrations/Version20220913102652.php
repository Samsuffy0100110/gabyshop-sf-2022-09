<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220913102652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE featured_products (id INT AUTO_INCREMENT NOT NULL,
        product_id INT DEFAULT NULL, position INT DEFAULT NULL,
        INDEX IDX_BB76A6674584665A (product_id),
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE featured_products ADD CONSTRAINT FK_BB76A6674584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE featured_products DROP FOREIGN KEY FK_BB76A6674584665A');
        $this->addSql('DROP TABLE featured_products');
    }
}
