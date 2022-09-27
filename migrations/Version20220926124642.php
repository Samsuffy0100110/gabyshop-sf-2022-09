<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926124642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE option_product (option_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_CBBE13D8A7C41D6F (option_id), INDEX IDX_CBBE13D84584665A (product_id), PRIMARY KEY(option_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE option_product ADD CONSTRAINT FK_CBBE13D8A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE option_product ADD CONSTRAINT FK_CBBE13D84584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE option_product DROP FOREIGN KEY FK_CBBE13D8A7C41D6F');
        $this->addSql('ALTER TABLE option_product DROP FOREIGN KEY FK_CBBE13D84584665A');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE option_product');
    }
}
