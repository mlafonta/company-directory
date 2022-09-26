<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220922143429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add some resources for testing';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            INSERT INTO resource
            VALUES 
                   (1, 3, 'Jira', 'Engineering ticketing system', 'https://kipsudev.atlassian.net/jira/your-work', true),
                   (2, 5, 'Payroll', 'Quickbooks access for Paychecks and W2s', 'https://workforce.intuit.com/app/payroll-employee-portal-ui', true),
                   (3, 1, 'Active=False test', 'Make sure I can do stuff with inactive resources', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', false),
                   (4, 3, 'Confluence', 'Documentation store for engineering', 'https://kipsudev.atlassian.net/wiki/home', true),   
                   (5, 3, 'Google Drive', 'Documentation store', 'https://drive.google.com/', true);
        ");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("
            DELETE FROM resource WHERE active IN (true, false);
        ");

    }
}
