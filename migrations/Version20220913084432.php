<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220913084432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE featured_products ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE featured_products 
        ADD CONSTRAINT FK_BB76A6674584665A 
        FOREIGN KEY (product_id) 
        REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_BB76A6674584665A ON featured_products (product_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD6AE2D748');
        $this->addSql('DROP INDEX IDX_D34A04AD6AE2D748 ON product');
        $this->addSql('ALTER TABLE product DROP featured_products_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE featured_products DROP FOREIGN KEY FK_BB76A6674584665A');
        $this->addSql('DROP INDEX IDX_BB76A6674584665A ON featured_products');
        $this->addSql('ALTER TABLE featured_products DROP product_id');
        $this->addSql('ALTER TABLE product ADD featured_products_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product 
        ADD CONSTRAINT FK_D34A04AD6AE2D748 
        FOREIGN KEY (featured_products_id) 
        REFERENCES featured_products (id) 
        ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D34A04AD6AE2D748 ON product (featured_products_id)');
    }
}
