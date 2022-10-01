<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220928183448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adding fake New Markets user';
    }

    public function up(Schema $schema): void
    {   //id, pronoun, he, she, they, desk
        $this->addSql("
            INSERT INTO desk
                VALUES (92, 8);
        ");

        $this->addSql("
        INSERT INTO users (\"id\", \"pronoun_id\", \"desk_id\", \"email\", \"roles\", \"password\", \"first_name\", \"last_name\", \"start_date\", \"image\", \"slack_username\", \"active\", \"position_id\")
                VALUES
                    (89, 1, 91, 'newMarkets@kipsu.com', '[\"user\"]', 'Kipsu123', 'New', 'Markets', '01/01/2000', 'blank-profile-picture.png', '@New Markets', true, 5);
        ");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("
            DELETE FROM desk WHERE id = 92;
        ");

        $this->addSql("
            DELETE FROM users WHERE id = 89;
        ");
    }
}