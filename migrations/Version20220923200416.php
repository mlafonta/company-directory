<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923200416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adding EE Role and Bridget and Val\'s desks';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            INSERT INTO position
                VALUES (61, 15, 'Enterprise Account Manager', false)
        ");

        $this->addSql("
            INSERT INTO desk
                VALUES (81, 6),
                       (82, 7),
                       (83, 8),
                       (84, 8),
                       (85, 8),
                       (86, 8),
                       (87, 8),
                       (88, 8),
                       (89, 8),
                       (90, 8),
                       (91, 8);
        ");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("
            DELETE FROM position WHERE id IN (61);
        ");

        $this->addSql("
            DELETE FROM desk WHERE id IN (81,82,83,84,85,86,87,88,89,90,91);
        ");
    }
}