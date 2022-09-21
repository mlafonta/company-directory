<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916161650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add parent_child relationships';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            INSERT INTO parent_child
                VALUES
                    (1, 1, 2),
                    (2, 1, 3),
                    (3, 1, 7),
                    (4, 1, 14),
                    (5, 1, 22),
                    (6, 1, 23),
                    (7, 3, 4),
                    (8, 3, 5),
                    (9, 3, 6),
                    (10, 7, 8),
                    (11, 7, 9),
                    (12, 7, 10),
                    (13, 7, 11),
                    (14, 7, 12),
                    (15, 7, 13),
                    (16, 14, 15),
                    (17, 14, 16),
                    (18, 14, 17),
                    (19, 17, 18),
                    (20, 17, 19),
                    (21, 17, 20),
                    (22, 17, 21);
        ");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("
            DELETE * FROM parent_child;
        ");
    }
}
