<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220922144632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'group_resource test data';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            INSERT INTO group_resource
            VALUES 
                   (1, 1, 1),
                   (2, 7, 1),
                   (3, 1, 2),
                   (4, 1, 1),
                   (5, 7, 4),
                   (6, 1, 5);
        ");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("
            DELETE FROM group_resource WHERE id IN (1,2,3,4,5,6);
        ");

    }
}
