<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916143815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add all groups';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            INSERT INTO \"group\"
                VALUES
                    (1, 'Kipsu', 'We create genuine human moments in an increasingly self-service world through digital messaging.'),
                    (2,'Human Resources', 'We keep our organization running smoothly and safely while scouting for talented individuals to join our mission.'),
                    (3, 'New Markets', 'We explore the new possibilities our organization can achieve.'),
                    (4, 'Customer Success, New Markets', 'We guide our partners in our New Market sector throughout their relationship with Kipsu.'),
                    (5, 'Healthcare', 'We are responsible for showing Kipsu to the healthcare industry and working with them to bring Kipsu to their teams.'),
                    (6, 'Multifamily', 'We are responsible for showing Kipsu to the residential industry and working with them to bring Kipsu to their teams.'),
                    (7, 'Engineering', 'We bring our vision for a human-centric service experience to life by developing, troubleshooting, and building applications.'),
                    (8, 'Squad K', 'We train new engineers on modern engineering concepts so they can excel as developers.'),
                    (9, 'Squad B', 'We build and maintain our DevOps and external systems to keep our processes running smoothly.'),
                    (10, 'Squad P4G', 'We build new features and maintain our code to ensure our customers have a wow experience.'),
                    (11, 'Squad D', 'We build new features and maintain our code to ensure our customers have a wow experience.'),
                    (12, 'Product', 'We work with our internal and external partners to improve and maintain our product.'),
                    (13, 'Quality Assurance', 'We inspect and test all of our releases to ensure everything runs as expected.'),
                    (14, 'Hospitality', 'We guide our partners in our Hospitality sector throughout their relationship with Kipsu.'),
                    (15, 'Enterprise Engagement', 'We specialize in creating custom solutions for large-scale partners.'),
                    (16, 'Customer Partnership', 'We are responsible for working with the hospitality industry to bring Kipsu to their teams.'),
                    (17, 'Customer Success', 'We guide our partners through setup and onboarding, engaging partners throughout their relationship with Kipsu, and offering support.'),
                    (18, 'Support Engineering', 'We bring people new to the tech industry into the fold and train them to be effective through support of our partners.'),
                    (19, 'Support', 'We help our partners resolve any issues they may find in a friendly and efficient manner.'),
                    (20, 'Onboarding', 'We set up new partners with Kipsu and train them on it to ensure their success with it.'),
                    (21, 'Engagement', 'We help existing partners continue to find value in Kipsu.'),
                    (22, 'Marketing', 'We are responsible for showing Kipsu to the world.'),
                    (23, 'Finance', 'We are responsible for financial reporting, forecasting, and working with our partners to ensure that the books are balanced.');
        ");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("
            DELETE * FROM \"group\";
        ");

    }
}
