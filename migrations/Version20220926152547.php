<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926152547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_social_question DROP CONSTRAINT fk_2a1ab1eda76ed395');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_social_question_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, pronoun_id INT DEFAULT NULL, desk_id INT DEFAULT NULL, position_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, start_date DATE NOT NULL, image VARCHAR(255) NOT NULL, slack_username VARCHAR(255) NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('CREATE INDEX IDX_1483A5E993BDCD30 ON users (pronoun_id)');
        $this->addSql('CREATE INDEX IDX_1483A5E971F9DF5E ON users (desk_id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9DD842E46 ON users (position_id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E993BDCD30 FOREIGN KEY (pronoun_id) REFERENCES pronoun (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E971F9DF5E FOREIGN KEY (desk_id) REFERENCES desk (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9DD842E46 FOREIGN KEY (position_id) REFERENCES position (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_social_question');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_social_question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, pronoun_id INT DEFAULT NULL, desk_id INT DEFAULT NULL, position_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, start_date DATE NOT NULL, image VARCHAR(255) NOT NULL, slack_username VARCHAR(255) NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_8d93d64971f9df5e ON "user" (desk_id)');
        $this->addSql('CREATE INDEX idx_8d93d649dd842e46 ON "user" (position_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649e7927c74 ON "user" (email)');
        $this->addSql('CREATE INDEX idx_8d93d64993bdcd30 ON "user" (pronoun_id)');
        $this->addSql('CREATE TABLE user_social_question (id INT NOT NULL, user_id INT NOT NULL, social_question_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_2a1ab1ed6b830691 ON user_social_question (social_question_id)');
        $this->addSql('CREATE INDEX idx_2a1ab1eda76ed395 ON user_social_question (user_id)');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk_8d93d64993bdcd30 FOREIGN KEY (pronoun_id) REFERENCES pronoun (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk_8d93d64971f9df5e FOREIGN KEY (desk_id) REFERENCES desk (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk_8d93d649dd842e46 FOREIGN KEY (position_id) REFERENCES "position" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_social_question ADD CONSTRAINT fk_2a1ab1eda76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_social_question ADD CONSTRAINT fk_2a1ab1ed6b830691 FOREIGN KEY (social_question_id) REFERENCES social_question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE users');
    }
}
