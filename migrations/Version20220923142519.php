<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923142519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add base pronouns';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            INSERT INTO pronoun
            VALUES 
                (1, 'he/him'),
                (2, 'she/her'),
                (3, 'they/them');
        ");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("
            DELETE * FROM pronoun;
        ");

    }
}