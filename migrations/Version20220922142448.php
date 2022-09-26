<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220922142448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Categories';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            INSERT INTO category
            VALUES 
                   (1, 'Social', 'Just for fun'),
                   (2, 'Onboarding', 'Get set up'),
                   (3, 'Documentation', 'Read about it'),
                   (4, 'Professional Development', 'Learn to do better'),
                   (5, 'HR', 'Human Resources needs');
        ");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("
            DELETE * FROM category;
        ");

    }
}
