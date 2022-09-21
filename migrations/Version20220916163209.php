<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916163209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parent_child DROP CONSTRAINT FK_EE82C08A727ACA70');
        $this->addSql('ALTER TABLE parent_child DROP CONSTRAINT FK_EE82C08ADD62C21B');
        $this->addSql('ALTER TABLE parent_child ADD CONSTRAINT FK_EE82C08A727ACA70 FOREIGN KEY (parent_id) REFERENCES "group" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE parent_child ADD CONSTRAINT FK_EE82C08ADD62C21B FOREIGN KEY (child_id) REFERENCES "group" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE parent_child DROP CONSTRAINT fk_ee82c08a727aca70');
        $this->addSql('ALTER TABLE parent_child DROP CONSTRAINT fk_ee82c08add62c21b');
        $this->addSql('ALTER TABLE parent_child ADD CONSTRAINT fk_ee82c08a727aca70 FOREIGN KEY (parent_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE parent_child ADD CONSTRAINT fk_ee82c08add62c21b FOREIGN KEY (child_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
