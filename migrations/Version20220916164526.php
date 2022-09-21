<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916164526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "position" ADD group_id INT NOT NULL');
        $this->addSql('ALTER TABLE "position" ADD CONSTRAINT FK_462CE4F5FE54D947 FOREIGN KEY (group_id) REFERENCES "group" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_462CE4F5FE54D947 ON "position" (group_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE position DROP CONSTRAINT FK_462CE4F5FE54D947');
        $this->addSql('DROP INDEX IDX_462CE4F5FE54D947');
        $this->addSql('ALTER TABLE position DROP group_id');
    }
}
