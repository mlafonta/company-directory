<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220825154446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_social_questions DROP CONSTRAINT fk_c59f4b7f60129df1');
        $this->addSql('DROP SEQUENCE social_questions_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_social_questions_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE membership_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE social_question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_membership_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_social_question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE membership (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE social_question (id INT NOT NULL, question VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_membership (id INT NOT NULL, user_id INT NOT NULL, membership_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_21981469A76ED395 ON user_membership (user_id)');
        $this->addSql('CREATE INDEX IDX_219814691FB354CD ON user_membership (membership_id)');
        $this->addSql('CREATE TABLE user_social_question (id INT NOT NULL, user_id INT NOT NULL, social_question_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2A1AB1EDA76ED395 ON user_social_question (user_id)');
        $this->addSql('CREATE INDEX IDX_2A1AB1ED6B830691 ON user_social_question (social_question_id)');
        $this->addSql('ALTER TABLE user_membership ADD CONSTRAINT FK_21981469A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_membership ADD CONSTRAINT FK_219814691FB354CD FOREIGN KEY (membership_id) REFERENCES membership (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_social_question ADD CONSTRAINT FK_2A1AB1EDA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_social_question ADD CONSTRAINT FK_2A1AB1ED6B830691 FOREIGN KEY (social_question_id) REFERENCES social_question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE user_social_questions');
        $this->addSql('DROP TABLE social_questions');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_membership DROP CONSTRAINT FK_219814691FB354CD');
        $this->addSql('ALTER TABLE user_social_question DROP CONSTRAINT FK_2A1AB1ED6B830691');
        $this->addSql('DROP SEQUENCE membership_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE social_question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_membership_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_social_question_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE social_questions_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_social_questions_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE user_social_questions (id INT NOT NULL, user_id INT NOT NULL, social_questions_id INT NOT NULL, answer VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_c59f4b7f60129df1 ON user_social_questions (social_questions_id)');
        $this->addSql('CREATE INDEX idx_c59f4b7fa76ed395 ON user_social_questions (user_id)');
        $this->addSql('CREATE TABLE social_questions (id INT NOT NULL, question VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE user_social_questions ADD CONSTRAINT fk_c59f4b7fa76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_social_questions ADD CONSTRAINT fk_c59f4b7f60129df1 FOREIGN KEY (social_questions_id) REFERENCES social_questions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE membership');
        $this->addSql('DROP TABLE social_question');
        $this->addSql('DROP TABLE user_membership');
        $this->addSql('DROP TABLE user_social_question');
    }
}
