<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220922205505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE group_slack DROP CONSTRAINT fk_84292f7d63f6d2c9');
        $this->addSql('ALTER TABLE membership_slack DROP CONSTRAINT fk_d8c8201763f6d2c9');
        $this->addSql('DROP SEQUENCE group_slack_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE membership_slack_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE slack_id_seq CASCADE');
        $this->addSql('DROP TABLE group_slack');
        $this->addSql('DROP TABLE slack');
        $this->addSql('DROP TABLE membership_slack');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE group_slack_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE membership_slack_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE slack_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE group_slack (id INT NOT NULL, group_data_id INT NOT NULL, slack_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_84292f7d63f6d2c9 ON group_slack (slack_id)');
        $this->addSql('CREATE INDEX idx_84292f7db1f5f530 ON group_slack (group_data_id)');
        $this->addSql('CREATE TABLE slack (id INT NOT NULL, category_id INT NOT NULL, channel VARCHAR(255) NOT NULL, topic VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_d405041a12469de2 ON slack (category_id)');
        $this->addSql('CREATE TABLE membership_slack (id INT NOT NULL, slack_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_d8c8201763f6d2c9 ON membership_slack (slack_id)');
        $this->addSql('ALTER TABLE group_slack ADD CONSTRAINT fk_84292f7db1f5f530 FOREIGN KEY (group_data_id) REFERENCES group_data (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_slack ADD CONSTRAINT fk_84292f7d63f6d2c9 FOREIGN KEY (slack_id) REFERENCES slack (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE slack ADD CONSTRAINT fk_d405041a12469de2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE membership_slack ADD CONSTRAINT fk_d8c8201763f6d2c9 FOREIGN KEY (slack_id) REFERENCES slack (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
