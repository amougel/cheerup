<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151010160421 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cheerup_group (id INT AUTO_INCREMENT NOT NULL, picture_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, offshoot TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_4E9B2DC5E237E06 (name), UNIQUE INDEX UNIQ_4E9B2DCEE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cheerup_picture (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cheerup_user_profile (id INT AUTO_INCREMENT NOT NULL, picture_id INT DEFAULT NULL, first_year_contact INT DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, additional_address_details VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(20) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, facebook_profile VARCHAR(255) DEFAULT NULL, twitter_profile VARCHAR(255) DEFAULT NULL, linked_in_profile VARCHAR(255) DEFAULT NULL, personal_website VARCHAR(255) DEFAULT NULL, phone_number INT DEFAULT NULL, cellphone_number INT DEFAULT NULL, UNIQUE INDEX UNIQ_622862E0EE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cheerup_security_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cheerup_user (id INT AUTO_INCREMENT NOT NULL, user_profile_id INT DEFAULT NULL, group_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, profile_type VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, validated TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_A2A731DA92FC23A8 (username_canonical), UNIQUE INDEX UNIQ_A2A731DAA0D96FBF (email_canonical), UNIQUE INDEX UNIQ_A2A731DA6B9DD454 (user_profile_id), INDEX IDX_A2A731DAFE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cheerup_user_user_security_group (user_id INT NOT NULL, security_group_id INT NOT NULL, INDEX IDX_CF6B4AA1A76ED395 (user_id), INDEX IDX_CF6B4AA19D3F5E95 (security_group_id), PRIMARY KEY(user_id, security_group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cheerup_group ADD CONSTRAINT FK_4E9B2DCEE45BDBF FOREIGN KEY (picture_id) REFERENCES cheerup_picture (id)');
        $this->addSql('ALTER TABLE cheerup_user_profile ADD CONSTRAINT FK_622862E0EE45BDBF FOREIGN KEY (picture_id) REFERENCES cheerup_picture (id)');
        $this->addSql('ALTER TABLE cheerup_user ADD CONSTRAINT FK_A2A731DA6B9DD454 FOREIGN KEY (user_profile_id) REFERENCES cheerup_user_profile (id)');
        $this->addSql('ALTER TABLE cheerup_user ADD CONSTRAINT FK_A2A731DAFE54D947 FOREIGN KEY (group_id) REFERENCES cheerup_group (id)');
        $this->addSql('ALTER TABLE cheerup_user_user_security_group ADD CONSTRAINT FK_CF6B4AA1A76ED395 FOREIGN KEY (user_id) REFERENCES cheerup_user (id)');
        $this->addSql('ALTER TABLE cheerup_user_user_security_group ADD CONSTRAINT FK_CF6B4AA19D3F5E95 FOREIGN KEY (security_group_id) REFERENCES cheerup_security_group (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cheerup_user DROP FOREIGN KEY FK_A2A731DAFE54D947');
        $this->addSql('ALTER TABLE cheerup_group DROP FOREIGN KEY FK_4E9B2DCEE45BDBF');
        $this->addSql('ALTER TABLE cheerup_user_profile DROP FOREIGN KEY FK_622862E0EE45BDBF');
        $this->addSql('ALTER TABLE cheerup_user DROP FOREIGN KEY FK_A2A731DA6B9DD454');
        $this->addSql('ALTER TABLE cheerup_user_user_security_group DROP FOREIGN KEY FK_CF6B4AA19D3F5E95');
        $this->addSql('ALTER TABLE cheerup_user_user_security_group DROP FOREIGN KEY FK_CF6B4AA1A76ED395');
        $this->addSql('DROP TABLE cheerup_group');
        $this->addSql('DROP TABLE cheerup_picture');
        $this->addSql('DROP TABLE cheerup_user_profile');
        $this->addSql('DROP TABLE cheerup_security_group');
        $this->addSql('DROP TABLE cheerup_user');
        $this->addSql('DROP TABLE cheerup_user_user_security_group');
    }
}
