<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220920220038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE group_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE parent_child_id_seq CASCADE');
        $this->addSql('DROP TABLE "group"');
        $this->addSql('DROP TABLE parent_child');
        $this->addSql('ALTER TABLE "position" ADD CONSTRAINT FK_462CE4F5FE54D947 FOREIGN KEY (group_id) REFERENCES group_data (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE parent_child_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "group" (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE parent_child (id INT NOT NULL, parent_id INT NOT NULL, child_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_ee82c08add62c21b ON parent_child (child_id)');
        $this->addSql('CREATE INDEX idx_ee82c08a727aca70 ON parent_child (parent_id)');
        $this->addSql('ALTER TABLE position DROP CONSTRAINT FK_462CE4F5FE54D947');
    }
}
