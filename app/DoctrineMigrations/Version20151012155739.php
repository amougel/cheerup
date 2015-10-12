<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151012155739 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cheerup_position ADD user_profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cheerup_position ADD CONSTRAINT FK_558FA2346B9DD454 FOREIGN KEY (user_profile_id) REFERENCES cheerup_user_profile (id)');
        $this->addSql('CREATE INDEX IDX_558FA2346B9DD454 ON cheerup_position (user_profile_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cheerup_position DROP FOREIGN KEY FK_558FA2346B9DD454');
        $this->addSql('DROP INDEX IDX_558FA2346B9DD454 ON cheerup_position');
        $this->addSql('ALTER TABLE cheerup_position DROP user_profile_id');
    }
}
