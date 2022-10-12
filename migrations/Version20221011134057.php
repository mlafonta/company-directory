<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221011134057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add new users';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            INSERT INTO users (\"id\", \"pronoun_id\", \"desk_id\", \"email\", \"roles\", \"password\", \"first_name\", \"last_name\", \"start_date\", \"image\", \"slack_member_id\", \"active\", \"position_id\")
                VALUES
                    (90, 1, 55, 'psoung@kipsu.com', '[\"user\"]', 'Kipsu123', 'Peter', 'Soung', '2022-10-11', 'blank-profile-picture.png', 'U046QPK8HPA', true, 34),
                    (91, 1, 55, 'lalfred@kipsu.com', '[\"user\"]', 'Kipsu123', 'Leo', 'Alfred', '2022-10-11', 'blank-profile-picture.png', 'U04612YPJLA', true, 21);
        ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
