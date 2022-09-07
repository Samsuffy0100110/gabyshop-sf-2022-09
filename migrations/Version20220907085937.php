<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220907085937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE banner (id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(255) DEFAULT NULL,
            image VARCHAR(255) DEFAULT NULL,
            position INT DEFAULT NULL,
            is_active TINYINT(1) DEFAULT NULL,
            created_at DATETIME DEFAULT NULL, 
            started_at DATETIME DEFAULT NULL, 
            ended_at DATETIME DEFAULT NULL, 
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, 
        parent_id INT DEFAULT NULL, 
        name VARCHAR(255) DEFAULT NULL, 
        description LONGTEXT DEFAULT NULL, 
        image VARCHAR(255) DEFAULT NULL, 
        INDEX IDX_64C19C1727ACA70 (parent_id), 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logo (id INT AUTO_INCREMENT NOT NULL, 
        name VARCHAR(255) DEFAULT NULL, 
        image VARCHAR(255) DEFAULT NULL, 
        position INT DEFAULT NULL, 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_letter (id INT AUTO_INCREMENT NOT NULL, 
        name VARCHAR(255) DEFAULT NULL, 
        title VARCHAR(255) DEFAULT NULL, 
        description LONGTEXT DEFAULT NULL, 
        created_at DATETIME DEFAULT NULL, 
        summary LONGTEXT DEFAULT NULL, 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_letter_user (id INT AUTO_INCREMENT NOT NULL, 
        email VARCHAR(255) NOT NULL, 
        uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, 
        name VARCHAR(255) DEFAULT NULL, 
        percent INT DEFAULT NULL, 
        reduce INT DEFAULT NULL, 
        is_active TINYINT(1) DEFAULT NULL, 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer_product (offer_id INT NOT NULL, 
        product_id INT NOT NULL, 
        INDEX IDX_7242C2A453C674EE (offer_id), 
        INDEX IDX_7242C2A44584665A (product_id), 
        PRIMARY KEY(offer_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parent_category (id INT AUTO_INCREMENT NOT NULL, 
        name VARCHAR(255) DEFAULT NULL, 
        image VARCHAR(255) DEFAULT NULL, 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, 
        taxe_id INT DEFAULT NULL, 
        category_id INT DEFAULT NULL, 
        name VARCHAR(255) DEFAULT NULL, 
        image1 VARCHAR(255) DEFAULT NULL, 
        image2 VARCHAR(255) DEFAULT NULL, 
        image3 VARCHAR(255) DEFAULT NULL, 
        image4 VARCHAR(255) DEFAULT NULL, 
        image0 VARCHAR(255) DEFAULT NULL, 
        price DOUBLE PRECISION NOT NULL, 
        quantity INT DEFAULT NULL, 
        created_at DATETIME DEFAULT NULL, 
        updated_at DATETIME DEFAULT NULL, 
        release_at DATETIME DEFAULT NULL, 
        summary LONGTEXT DEFAULT NULL, 
        description LONGTEXT DEFAULT NULL, 
        weight NUMERIC(10, 3) DEFAULT NULL, 
        INDEX IDX_D34A04AD1AB947A4 (taxe_id), 
        INDEX IDX_D34A04AD12469DE2 (category_id), 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate (id INT AUTO_INCREMENT NOT NULL, 
        product_id INT DEFAULT NULL, 
        user_id INT DEFAULT NULL, 
        comment LONGTEXT DEFAULT NULL, 
        stars INT DEFAULT NULL, 
        INDEX IDX_DFEC3F394584665A (product_id), 
        INDEX IDX_DFEC3F39A76ED395 (user_id), 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop (id INT AUTO_INCREMENT NOT NULL, 
        name VARCHAR(255) NOT NULL, 
        shop_number_pro VARCHAR(255) DEFAULT NULL, 
        adress VARCHAR(255) DEFAULT NULL, 
        city VARCHAR(255) DEFAULT NULL, 
        country VARCHAR(255) DEFAULT NULL, 
        zipcode VARCHAR(255) DEFAULT NULL, 
        phone VARCHAR(255) DEFAULT NULL, 
        mail VARCHAR(255) DEFAULT NULL, 
        description LONGTEXT DEFAULT NULL, 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taxe (id INT AUTO_INCREMENT NOT NULL, 
        name VARCHAR(255) DEFAULT NULL, 
        percent DOUBLE PRECISION DEFAULT NULL, 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, 
        name VARCHAR(255) DEFAULT NULL, 
        color_menu VARCHAR(255) DEFAULT NULL, 
        background_color VARCHAR(255) DEFAULT NULL, 
        footer_color VARCHAR(255) DEFAULT NULL, 
        is_active TINYINT(1) DEFAULT NULL, 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, 
        email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, 
        firstname VARCHAR(255) NOT NULL, 
        lastname VARCHAR(255) NOT NULL, 
        adress VARCHAR(255) DEFAULT NULL, 
        city VARCHAR(255) DEFAULT NULL, 
        zipcode VARCHAR(255) DEFAULT NULL, 
        country VARCHAR(255) DEFAULT NULL, 
        phone VARCHAR(255) DEFAULT NULL, 
        is_pro TINYINT(1) DEFAULT NULL, 
        idpro VARCHAR(255) DEFAULT NULL, 
        companyname VARCHAR(255) DEFAULT NULL, 
        is_newsletter_ok TINYINT(1) DEFAULT NULL, 
        UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, 
        body LONGTEXT NOT NULL, 
        headers LONGTEXT NOT NULL, 
        queue_name VARCHAR(190) NOT NULL, 
        created_at DATETIME NOT NULL, 
        available_at DATETIME NOT NULL, 
        delivered_at DATETIME DEFAULT NULL, 
        INDEX IDX_75EA56E0FB7336F0 (queue_name), 
        INDEX IDX_75EA56E0E3BD61CE (available_at), 
        INDEX IDX_75EA56E016BA31DB (delivered_at), 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category 
        ADD CONSTRAINT FK_64C19C1727ACA70 
        FOREIGN KEY (parent_id) 
        REFERENCES parent_category (id)');
        $this->addSql('ALTER TABLE offer_product 
        ADD CONSTRAINT FK_7242C2A453C674EE 
        FOREIGN KEY (offer_id) 
        REFERENCES offer (id) 
        ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer_product 
        ADD CONSTRAINT FK_7242C2A44584665A 
        FOREIGN KEY (product_id) 
        REFERENCES product (id) 
        ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product 
        ADD CONSTRAINT FK_D34A04AD1AB947A4 
        FOREIGN KEY (taxe_id) 
        REFERENCES taxe (id)');
        $this->addSql('ALTER TABLE product 
        ADD CONSTRAINT FK_D34A04AD12469DE2 
        FOREIGN KEY (category_id) 
        REFERENCES category (id)');
        $this->addSql('ALTER TABLE rate 
        ADD CONSTRAINT FK_DFEC3F394584665A 
        FOREIGN KEY (product_id) 
        REFERENCES product (id)');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F39A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE offer_product DROP FOREIGN KEY FK_7242C2A453C674EE');
        $this->addSql('ALTER TABLE offer_product DROP FOREIGN KEY FK_7242C2A44584665A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD1AB947A4');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F394584665A');
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F39A76ED395');
        $this->addSql('DROP TABLE banner');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE logo');
        $this->addSql('DROP TABLE news_letter');
        $this->addSql('DROP TABLE news_letter_user');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE offer_product');
        $this->addSql('DROP TABLE parent_category');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE rate');
        $this->addSql('DROP TABLE shop');
        $this->addSql('DROP TABLE taxe');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
