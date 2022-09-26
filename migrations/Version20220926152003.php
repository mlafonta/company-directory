<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926152003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_membership DROP CONSTRAINT fk_219814691fb354cd');
        $this->addSql('DROP SEQUENCE membership_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE membership_resource_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_membership_id_seq CASCADE');
        $this->addSql('DROP TABLE membership_resource');
        $this->addSql('DROP TABLE user_membership');
        $this->addSql('DROP TABLE membership');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE membership_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE membership_resource_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_membership_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE membership_resource (id INT NOT NULL, resource_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_a07438e289329d25 ON membership_resource (resource_id)');
        $this->addSql('CREATE TABLE user_membership (id INT NOT NULL, user_id INT NOT NULL, membership_id INT NOT NULL, is_lead BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_219814691fb354cd ON user_membership (membership_id)');
        $this->addSql('CREATE INDEX idx_21981469a76ed395 ON user_membership (user_id)');
        $this->addSql('CREATE TABLE membership (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE membership_resource ADD CONSTRAINT fk_a07438e289329d25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_membership ADD CONSTRAINT fk_21981469a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_membership ADD CONSTRAINT fk_219814691fb354cd FOREIGN KEY (membership_id) REFERENCES membership (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
