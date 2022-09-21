<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916164731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add all positions';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            INSERT INTO position
                VALUES 
                   (1, 'President and CEO', true, 1),
                   (2, 'Office Manager', false, 1),
                   (3, 'Vice President of Human Resources', true, 2),
                   (4, 'Senior Recruiter', false, 2),
                   (5, 'Vice President of New Markets', true, 3),
                   (6, 'Manager of Customer Success, New Markets', true, 4),
                   (7, 'Customer Success Representative, New Markets', false, 4),
                   (8, 'Director of Business Development, Healthcare', true, 5),
                   (9, 'Senior New Markets Analyst', false, 5),
                   (10, 'Manager of New Customer Acquisition, Multifamily', true, 6),
                   (11, 'Vice President of Engineering', true, 7),
                   (12, 'Director of Program Management', false, 7),
                   (13, 'Director of Engineering', true, 8),
                   (14, 'Software Engineer', false, 8),
                   (15, 'DevOps Manager', true, 9),
                   (16, 'Staff Software Engineer', false, 9),
                   (17, 'Senior Software Engineer', false, 9),
                   (18, 'Security Software Engineer', false, 9),
                   (19, 'Software Engineering Manager', true, 10),
                   (20, 'Software Engineer', false, 10),
                   (21, 'Senior Software Engineer', false, 10),
                   (22, 'Software Engineering Manager', true, 11),
                   (23, 'Software Engineer', false, 11),
                   (24, 'Senior Software Engineer', false, 11),
                   (25, 'Staff Software Engineer', false, 11),
                   (26, 'Data Science Intern', false, 11),
                   (27, 'Product Manager', true, 12),
                   (28, 'Product Analyst', false, 12),
                   (29, 'Senior Product Analyst', false, 12),
                   (30, 'Rotation Analyst, Product', false, 12),
                   (31, 'Quality Assurance Manager', true, 13),
                   (32, 'Quality Assurance Analyst', false, 13),
                   (33, 'Senior Vice President and General Manager of Hospitality', true, 14),
                   (34, 'Vice President of Enterprise Engagement', true, 15),
                   (35, 'Senior Enterprise Account Manager', false, 15),
                   (36, 'Vice President of Hospitality, Customer Partnerships', true, 16),
                   (37, 'Account Executive', false, 16),
                   (38, 'Sales Representative', false, 16),
                   (39, 'Vice President of Customer Success', true, 17),
                   (40, 'Support Engineering Manager', true, 18),
                   (41, 'Support Engineer', false, 18),
                   (42, 'Support Manager', true, 19),
                   (43, 'Customer Support Representative', false, 19),
                   (44, 'Senior Customer Support Representative', false, 19),
                   (45, 'Onboarding Manager', true, 20),
                   (46, 'Customer Onboarding Representative', false, 20),
                   (47, 'Engagement Manager', true, 21),
                   (48, 'Customer Success Representative', false, 21),
                   (49, 'Senior Customer Success Representative', false, 21),
                   (50, 'Vice President of Marketing', true, 22),
                   (51, 'Marketing Manager', false, 22),
                   (52, 'Content Developer', false, 22),
                   (53, 'Email Demand Generation Manager', false, 22),
                   (54, 'Marketing Intern', false, 22),
                   (55, 'Digital Marketing Manager', false, 22),
                   (56, 'Vice President of Finance', true, 23),
                   (57, 'Revenue Operations Manager', false, 23),
                   (58, 'Assistant Controller', false, 23),
                   (59, 'Contactor, Finance', false, 23),
                   (60, 'Accounting Specialist', false, 23);
        ");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("
            DELETE * FROM position;
        ");

    }
}
