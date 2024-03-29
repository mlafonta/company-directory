<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923195257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ADD position_id INT NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649DD842E46 FOREIGN KEY (position_id) REFERENCES position (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8D93D649DD842E46 ON "user" (position_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649DD842E46');
        $this->addSql('DROP INDEX IDX_8D93D649DD842E46');
        $this->addSql('ALTER TABLE "user" DROP position_id');
    }
}
