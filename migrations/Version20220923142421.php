<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923142421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add desks';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            INSERT INTO desk
                VALUES 
                      (1, 6),
                      (2, 6),
                      (3, 6),
                      (4, 6),
                      (5, 6),
                      (6, 6),
                      (7, 6),
                      (8, 6),
                      (9, 6),
                      (10, 6),
                      (11, 6),
                      (12, 6),
                      (13, 6),
                      (14, 6),
                      (15, 6),
                      (16, 6),
                      (17, 6),
                      (18, 6),
                      (19, 6),
                      (20, 6),
                      (21, 6),
                      (22, 6),
                      (23, 6),
                      (24, 6),
                      (25, 6),
                      (26, 6),
                      (27, 6),
                      (28, 6),
                      (29, 6),
                      (30, 6),
                      (31, 6),
                      (32, 6),
                      (33, 6),
                      (34, 6),
                      (35, 7),
                      (36, 7),
                      (37, 7),
                      (38, 7),
                      (39, 7),
                      (40, 7),
                      (41, 7),
                      (42, 7),
                      (43, 7),
                      (44, 7),
                      (45, 7),
                      (46, 7),
                      (47, 7),
                      (48, 7),
                      (49, 7),
                      (50, 7),
                      (51, 7),
                      (52, 7),
                      (53, 7),
                      (54, 7),
                      (55, 7),
                      (56, 7),
                      (57, 7),
                      (58, 7),
                      (59, 7),
                      (60, 7),
                      (61, 7),
                      (62, 7),
                      (63, 7),
                      (64, 7),
                      (65, 7),
                      (66, 7),
                      (67, 7),
                      (68, 7),
                      (69, 7),
                      (70, 7),
                      (71, 7),
                      (72, 7),
                      (73, 7),
                      (74, 7),
                      (75, 7),
                      (76, 7),
                      (77, 7),
                      (78, 7),
                      (79, 7),
                      (80, 7);                     
        ");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("
            DELETE * FROM desk;
        ");

    }
}
