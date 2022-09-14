<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220909193736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "group" DROP CONSTRAINT fk_6dc044c5434cd89f');
        $this->addSql('DROP SEQUENCE group_type_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE membership_resource_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE membership_slack_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE membership_resource (id INT NOT NULL, resource_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A07438E289329D25 ON membership_resource (resource_id)');
        $this->addSql('CREATE TABLE membership_slack (id INT NOT NULL, slack_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D8C8201763F6D2C9 ON membership_slack (slack_id)');
        $this->addSql('ALTER TABLE membership_resource ADD CONSTRAINT FK_A07438E289329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE membership_slack ADD CONSTRAINT FK_D8C8201763F6D2C9 FOREIGN KEY (slack_id) REFERENCES slack (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE group_type');
        $this->addSql('DROP INDEX idx_6dc044c5434cd89f');
        $this->addSql('ALTER TABLE "group" DROP group_type_id');
        $this->addSql('ALTER TABLE user_membership ADD is_lead BOOLEAN NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE membership_resource_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE membership_slack_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE group_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE group_type (id INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE membership_resource');
        $this->addSql('DROP TABLE membership_slack');
        $this->addSql('ALTER TABLE "group" ADD group_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE "group" ADD CONSTRAINT fk_6dc044c5434cd89f FOREIGN KEY (group_type_id) REFERENCES group_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_6dc044c5434cd89f ON "group" (group_type_id)');
        $this->addSql('ALTER TABLE user_membership DROP is_lead');
    }
}
