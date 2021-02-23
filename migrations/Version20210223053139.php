<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210223053139 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE business (id INT AUTO_INCREMENT NOT NULL, logo_id INT DEFAULT NULL, ubigeo_id INT NOT NULL, name VARCHAR(255) NOT NULL, alias VARCHAR(255) DEFAULT NULL, address VARCHAR(255) NOT NULL, tel VARCHAR(255) DEFAULT NULL, dm VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, lat DOUBLE PRECISION NOT NULL, lng DOUBLE PRECISION NOT NULL, information LONGTEXT DEFAULT NULL, video_url VARCHAR(255) DEFAULT NULL, web_url VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D36E38F98F144A (logo_id), INDEX IDX_8D36E386EBB006C (ubigeo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE business_category (business_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_E7C1757A89DB457 (business_id), INDEX IDX_E7C175712469DE2 (category_id), PRIMARY KEY(business_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE business_hours (id INT AUTO_INCREMENT NOT NULL, business_id INT NOT NULL, day INT NOT NULL, open_time TIME NOT NULL, close_time TIME NOT NULL, INDEX IDX_F4FB5A32A89DB457 (business_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, alias VARCHAR(25) NOT NULL, icon VARCHAR(25) NOT NULL, parent_id INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE checkin (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, business_id INT NOT NULL, INDEX IDX_E1631C91A76ED395 (user_id), INDEX IDX_E1631C91A89DB457 (business_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, alt VARCHAR(255) DEFAULT NULL, src VARCHAR(255) NOT NULL, width INT NOT NULL, height INT NOT NULL, size DOUBLE PRECISION NOT NULL, INDEX IDX_C53D045FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, ubigeo_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, alias VARCHAR(255) DEFAULT NULL, email_secondary VARCHAR(255) DEFAULT NULL, birth_date DATE DEFAULT NULL, marital_status INT DEFAULT NULL, gender VARCHAR(1) NOT NULL, description VARCHAR(255) DEFAULT NULL, razon_social VARCHAR(255) DEFAULT NULL, ruc INT DEFAULT NULL, address_delivery VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, tel VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8157AA0FA76ED395 (user_id), INDEX IDX_8157AA0F6EBB006C (ubigeo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, business_id INT NOT NULL, score INT NOT NULL, max INT NOT NULL, INDEX IDX_D8892622A76ED395 (user_id), INDEX IDX_D8892622A89DB457 (business_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, message VARCHAR(255) DEFAULT NULL, INDEX IDX_794381C6A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ubigeo (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) DEFAULT NULL, code INT DEFAULT NULL, abbreviation VARCHAR(5) DEFAULT NULL, type VARCHAR(1) NOT NULL, lat DOUBLE PRECISION NOT NULL, lng DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, api_token VARCHAR(255) DEFAULT NULL, facebook_id VARCHAR(255) DEFAULT NULL, google_id VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6497BA2F5EB (api_token), UNIQUE INDEX UNIQ_8D93D6499BE8FD98 (facebook_id), UNIQUE INDEX UNIQ_8D93D64976F5C865 (google_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE business ADD CONSTRAINT FK_8D36E38F98F144A FOREIGN KEY (logo_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE business ADD CONSTRAINT FK_8D36E386EBB006C FOREIGN KEY (ubigeo_id) REFERENCES ubigeo (id)');
        $this->addSql('ALTER TABLE business_category ADD CONSTRAINT FK_E7C1757A89DB457 FOREIGN KEY (business_id) REFERENCES business (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE business_category ADD CONSTRAINT FK_E7C175712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE business_hours ADD CONSTRAINT FK_F4FB5A32A89DB457 FOREIGN KEY (business_id) REFERENCES business (id)');
        $this->addSql('ALTER TABLE checkin ADD CONSTRAINT FK_E1631C91A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE checkin ADD CONSTRAINT FK_E1631C91A89DB457 FOREIGN KEY (business_id) REFERENCES business (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F6EBB006C FOREIGN KEY (ubigeo_id) REFERENCES ubigeo (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A89DB457 FOREIGN KEY (business_id) REFERENCES business (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE business_category DROP FOREIGN KEY FK_E7C1757A89DB457');
        $this->addSql('ALTER TABLE business_hours DROP FOREIGN KEY FK_F4FB5A32A89DB457');
        $this->addSql('ALTER TABLE checkin DROP FOREIGN KEY FK_E1631C91A89DB457');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A89DB457');
        $this->addSql('ALTER TABLE business_category DROP FOREIGN KEY FK_E7C175712469DE2');
        $this->addSql('ALTER TABLE business DROP FOREIGN KEY FK_8D36E38F98F144A');
        $this->addSql('ALTER TABLE business DROP FOREIGN KEY FK_8D36E386EBB006C');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F6EBB006C');
        $this->addSql('ALTER TABLE checkin DROP FOREIGN KEY FK_E1631C91A76ED395');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FA76ED395');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0FA76ED395');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A76ED395');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6A76ED395');
        $this->addSql('DROP TABLE business');
        $this->addSql('DROP TABLE business_category');
        $this->addSql('DROP TABLE business_hours');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE checkin');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE ubigeo');
        $this->addSql('DROP TABLE `user`');
    }
}
