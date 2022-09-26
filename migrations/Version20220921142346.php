<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220921142346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE desk_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE group_data_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE group_resource_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE group_slack_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE membership_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE membership_resource_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE membership_slack_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE parent_child_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE position_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pronoun_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE resource_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE slack_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE social_question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_membership_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_social_question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, category VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE desk (id INT NOT NULL, location INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE group_data (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE group_resource (id INT NOT NULL, group_data_id INT NOT NULL, resource_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B5A1B869B1F5F530 ON group_resource (group_data_id)');
        $this->addSql('CREATE INDEX IDX_B5A1B86989329D25 ON group_resource (resource_id)');
        $this->addSql('CREATE TABLE group_slack (id INT NOT NULL, group_data_id INT NOT NULL, slack_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_84292F7DB1F5F530 ON group_slack (group_data_id)');
        $this->addSql('CREATE INDEX IDX_84292F7D63F6D2C9 ON group_slack (slack_id)');
        $this->addSql('CREATE TABLE membership (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE membership_resource (id INT NOT NULL, resource_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A07438E289329D25 ON membership_resource (resource_id)');
        $this->addSql('CREATE TABLE membership_slack (id INT NOT NULL, slack_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D8C8201763F6D2C9 ON membership_slack (slack_id)');
        $this->addSql('CREATE TABLE parent_child (id INT NOT NULL, parent_id INT NOT NULL, child_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EE82C08A727ACA70 ON parent_child (parent_id)');
        $this->addSql('CREATE INDEX IDX_EE82C08ADD62C21B ON parent_child (child_id)');
        $this->addSql('CREATE TABLE position (id INT NOT NULL, group_data_id INT NOT NULL, name VARCHAR(255) NOT NULL, is_lead BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_462CE4F5B1F5F530 ON position (group_data_id)');
        $this->addSql('CREATE TABLE pronoun (id INT NOT NULL, pronouns VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE resource (id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BC91F41612469DE2 ON resource (category_id)');
        $this->addSql('CREATE TABLE slack (id INT NOT NULL, category_id INT NOT NULL, channel VARCHAR(255) NOT NULL, topic VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D405041A12469DE2 ON slack (category_id)');
        $this->addSql('CREATE TABLE social_question (id INT NOT NULL, question VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, pronoun_id INT DEFAULT NULL, desk_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, start_date DATE NOT NULL, image VARCHAR(255) NOT NULL, slack_username VARCHAR(255) NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE INDEX IDX_8D93D64993BDCD30 ON "user" (pronoun_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64971F9DF5E ON "user" (desk_id)');
        $this->addSql('CREATE TABLE user_membership (id INT NOT NULL, user_id INT NOT NULL, membership_id INT NOT NULL, is_lead BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_21981469A76ED395 ON user_membership (user_id)');
        $this->addSql('CREATE INDEX IDX_219814691FB354CD ON user_membership (membership_id)');
        $this->addSql('CREATE TABLE user_social_question (id INT NOT NULL, user_id INT NOT NULL, social_question_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2A1AB1EDA76ED395 ON user_social_question (user_id)');
        $this->addSql('CREATE INDEX IDX_2A1AB1ED6B830691 ON user_social_question (social_question_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE group_resource ADD CONSTRAINT FK_B5A1B869B1F5F530 FOREIGN KEY (group_data_id) REFERENCES group_data (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_resource ADD CONSTRAINT FK_B5A1B86989329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_slack ADD CONSTRAINT FK_84292F7DB1F5F530 FOREIGN KEY (group_data_id) REFERENCES group_data (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_slack ADD CONSTRAINT FK_84292F7D63F6D2C9 FOREIGN KEY (slack_id) REFERENCES slack (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE membership_resource ADD CONSTRAINT FK_A07438E289329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE membership_slack ADD CONSTRAINT FK_D8C8201763F6D2C9 FOREIGN KEY (slack_id) REFERENCES slack (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE parent_child ADD CONSTRAINT FK_EE82C08A727ACA70 FOREIGN KEY (parent_id) REFERENCES group_data (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE parent_child ADD CONSTRAINT FK_EE82C08ADD62C21B FOREIGN KEY (child_id) REFERENCES group_data (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F5B1F5F530 FOREIGN KEY (group_data_id) REFERENCES group_data (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F41612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE slack ADD CONSTRAINT FK_D405041A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D64993BDCD30 FOREIGN KEY (pronoun_id) REFERENCES pronoun (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D64971F9DF5E FOREIGN KEY (desk_id) REFERENCES desk (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_membership ADD CONSTRAINT FK_21981469A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_membership ADD CONSTRAINT FK_219814691FB354CD FOREIGN KEY (membership_id) REFERENCES membership (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_social_question ADD CONSTRAINT FK_2A1AB1EDA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_social_question ADD CONSTRAINT FK_2A1AB1ED6B830691 FOREIGN KEY (social_question_id) REFERENCES social_question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE resource DROP CONSTRAINT FK_BC91F41612469DE2');
        $this->addSql('ALTER TABLE slack DROP CONSTRAINT FK_D405041A12469DE2');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D64971F9DF5E');
        $this->addSql('ALTER TABLE group_resource DROP CONSTRAINT FK_B5A1B869B1F5F530');
        $this->addSql('ALTER TABLE group_slack DROP CONSTRAINT FK_84292F7DB1F5F530');
        $this->addSql('ALTER TABLE parent_child DROP CONSTRAINT FK_EE82C08A727ACA70');
        $this->addSql('ALTER TABLE parent_child DROP CONSTRAINT FK_EE82C08ADD62C21B');
        $this->addSql('ALTER TABLE position DROP CONSTRAINT FK_462CE4F5B1F5F530');
        $this->addSql('ALTER TABLE user_membership DROP CONSTRAINT FK_219814691FB354CD');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D64993BDCD30');
        $this->addSql('ALTER TABLE group_resource DROP CONSTRAINT FK_B5A1B86989329D25');
        $this->addSql('ALTER TABLE membership_resource DROP CONSTRAINT FK_A07438E289329D25');
        $this->addSql('ALTER TABLE group_slack DROP CONSTRAINT FK_84292F7D63F6D2C9');
        $this->addSql('ALTER TABLE membership_slack DROP CONSTRAINT FK_D8C8201763F6D2C9');
        $this->addSql('ALTER TABLE user_social_question DROP CONSTRAINT FK_2A1AB1ED6B830691');
        $this->addSql('ALTER TABLE user_membership DROP CONSTRAINT FK_21981469A76ED395');
        $this->addSql('ALTER TABLE user_social_question DROP CONSTRAINT FK_2A1AB1EDA76ED395');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE desk_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE group_data_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE group_resource_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE group_slack_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE membership_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE membership_resource_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE membership_slack_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE parent_child_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE position_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pronoun_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE resource_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE slack_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE social_question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_membership_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_social_question_id_seq CASCADE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE desk');
        $this->addSql('DROP TABLE group_data');
        $this->addSql('DROP TABLE group_resource');
        $this->addSql('DROP TABLE group_slack');
        $this->addSql('DROP TABLE membership');
        $this->addSql('DROP TABLE membership_resource');
        $this->addSql('DROP TABLE membership_slack');
        $this->addSql('DROP TABLE parent_child');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE pronoun');
        $this->addSql('DROP TABLE resource');
        $this->addSql('DROP TABLE slack');
        $this->addSql('DROP TABLE social_question');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_membership');
        $this->addSql('DROP TABLE user_social_question');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
