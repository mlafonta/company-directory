<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923201438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adding all users';
    }

    public function up(Schema $schema): void
    {   //id, pronoun, he, she, they, desk
        $this->addSql("
            INSERT INTO \"user\" 
                VALUES 
                    (1, 1, 34, 'chris@kipsu.com', '\"admin\"', 'Kipsu123', 'Chris', 'Smith', '01/01/2000', 'blank-profile-picture.png', '@Chris', true, 1),
                    (2, 2, 81, 'bfortin@kipsu.com', '\"admin\"', 'Kipsu123', 'Bridget', 'Fortin', '01/01/2000', 'blank-profile-picture.png', '@Bridget Fortin', true, 2),
                    (3, 2, 82, 'vjust@kipsu.com', '\"admin\"', 'Kipsu123', 'Valerie', 'Just', '01/01/2000', 'blank-profile-picture.png', '@Valerie Just', true, 3),
                    (4, 1, 10, 'mdavis@kipsu.com', '\"admin\"', 'Kipsu123', 'Michael', 'Davis', '01/01/2000', 'blank-profile-picture.png', '@Michael Davis', true, 4),
                    (5, 2, 2, 'aboegel@kipsu.com', '\"user\"', 'Kipsu123', 'Ashley', 'Boegel', '01/01/2000', 'blank-profile-picture.png', '@Ashley', true, 6),
                    (6, 1, 3, 'esalau@kipsu.com', '\"user\"', 'Kipsu123', 'Ethan', 'Salau', '01/01/2000', 'blank-profile-picture.png', '@Ethan Salau', true, 7),
                    (7, 1, 8, 'dlindsey@kipsu.com', '\"user\"', 'Kipsu123', 'Danny', 'Lindsey', '01/01/2000', 'blank-profile-picture.png', '@Danny Lindsey', true, 8),
                    (8, 1, 1, 'jgrunow@kipsu.com', '\"user\"', 'Kipsu123', 'Joe', 'Grunow', '01/01/2000', 'blank-profile-picture.png', '@Joe Grunow', true, 9),
                    (9, 2, 4, 'cmulso@kipsu.com', '\"user\"', 'Kipsu123', 'Cathryn', 'Mulso', '01/01/2000', 'blank-profile-picture.png', '@Cathryn Mulso', true, 10),
                    (10, 1, 80, 'osmihi@kipsu.com', '\"user\"', 'Kipsu123', 'Othman', 'Smihi', '01/01/2000', 'blank-profile-picture.png', '@osmihi', true, 11),
                    (11, 1, 18, 'araybin@kipsu.com', '\"user\"', 'Kipsu123', 'Adam', 'Raybin', '01/01/2000', 'blank-profile-picture.png', '@Adam Raybin', true, 12),
                    (12, 1, 74, 'kronning@kipsu.com', '\"user\"', 'Kipsu123', 'Kyle', 'Ronning', '01/01/2000', 'blank-profile-picture.png', '@Kyle', true, 13),
                    (13, 1, 70, 'mlafontant@kipsu.com', '\"admin\"', 'Kipsu123', 'Maxwell', 'Lafontant', '01/01/2000', 'blank-profile-picture.png', '@Maxwell Lafontant', true, 14), 
                    (14, 1, 66, 'dsorthepharack@kipsu.com', '\"user\"', 'Kipsu123', 'Det', 'Sorthepharack', '01/01/2000', 'blank-profile-picture.png', '@Det Sorthepharack', true, 14),
                    (15, 1, 58, 'mbouc@kipsu.com', '\"user\"', 'Kipsu123', 'Matt', 'Bouc', '01/01/2000', 'blank-profile-picture.png', '@Matt Bouc', true, 14),
                    (16, 1, 72, 'jcloeter@kipsu.com', '\"user\"', 'Kipsu123', 'John', 'Cloeter', '01/01/2000', 'blank-profile-picture.png', '@John Cloeter', true, 14),
                    (17, 1, 62, 'jharder@kipsu.com', '\"user\"', 'Kipsu123', 'Jon', 'Harder', '01/01/2000', 'blank-profile-picture.png', '@Jon Harder', true, 15),
                    (18, 1, 60, 'rbloom@kipsu.com', '\"user\"', 'Kipsu123', 'Ryan', 'Bloom', '01/01/2000', 'blank-profile-picture.png', '@Ryan', true, 16),
                    (19, 1, 61, 'clee@kipsu.com', '\"user\"', 'Kipsu123', 'Chee', 'Lee', '01/01/2000', 'blank-profile-picture.png', '@Chee Lee', true, 17),
                    (20, 1, 59, 'mnguyen@kipsu.com', '\"user\"', 'Kipsu123', 'Minh', 'Nguyen', '01/01/2000', 'blank-profile-picture.png', '@Minh Nguyen', true, 17),
                    (21, 1, 68, 'areese@kipsu.com', '\"user\"', 'Kipsu123', 'Austin', 'Reese', '01/01/2000', 'blank-profile-picture.png', '@Austin Reese', true, 18),
                    (22, 1, 67, 'pduryea@kipsu.com', '\"user\"', 'Kipsu123', 'Peter', 'Duryea', '01/01/2000', 'blank-profile-picture.png', '@Peter Duryea', true, 19),
                    (23, 1, 73, 'lhirsch@kipsu.com', '\"user\"', 'Kipsu123', 'Lukas', 'Hirsch', '01/01/2000', 'blank-profile-picture.png', '@Lukas Hirsch', true, 20),
                    (24, 1, 83, 'bmerz@kipsu.com', '\"user\"', 'Kipsu123', 'Brian', 'Merz', '01/01/2000', 'blank-profile-picture.png', '@Sir Merz', true, 21),
                    (25, 1, 64, 'aassefa@kipsu.com', '\"user\"', 'Kipsu123', 'Adam', 'Assefa', '01/01/2000', 'blank-profile-picture.png', '@Adam Assefa', true, 21),
                    (26, 1, 52, 'chayes@kipsu.com', '\"user\"', 'Kipsu123', 'Chris', 'Hayes', '01/01/2000', 'blank-profile-picture.png', '@Chris Hayes', true, 22),
                    (27, 1, 51, 'solson@kipsu.com', '\"user\"', 'Kipsu123', 'Sean', 'Olson', '01/01/2000', 'blank-profile-picture.png', '@Sean Olson', true, 23),
                    (28, 1, 53, 'dschmitz@kipsu.com', '\"user\"', 'Kipsu123', 'Doug', 'Schmitz', '01/01/2000', 'blank-profile-picture.png', '@Doug Schmitz', true, 23),
                    (29, 1, 56, 'jajala@kipsu.com', '\"user\"', 'Kipsu123', 'John', 'Ajala', '01/01/2000', 'blank-profile-picture.png', '@No Nap (Ajala)', true, 24),
                    (30, 1, 55, 'jcarr@kipsu.com', '\"user\"', 'Kipsu123', 'Jordan', 'Carr', '01/01/2000', 'blank-profile-picture.png', '@Jordan Carr', true, 25),
                    (31, 1, 69, 'wcooper@kipsu.com', '\"user\"', 'Kipsu123', 'Will', 'Cooper', '01/01/2000', 'blank-profile-picture.png', '@Will Cooper', true, 23),
                    (32, 1, 54, 'ageier@kipsu.com', '\"user\"', 'Kipsu123', 'Andrew', 'Geier', '01/01/2000', 'blank-profile-picture.png', '@shygeier', true, 24),
                    (33, 2, 71, 'ssudheendra@kipsu.com', '\"user\"', 'Kipsu123', 'Smitha', 'Sudheendra', '01/01/2000', 'blank-profile-picture.png', '@Smitha Sudheendra', false, 26),
                    (34, 2, 25, 'cchristiansen@kipsu.com', '\"user\"', 'Kipsu123', 'Cara', 'Christiansen', '01/01/2000', 'blank-profile-picture.png', '@caramel', true, 27),
                    (35, 2, 26, 'eshiring@kipsu.com', '\"user\"', 'Kipsu123', 'Emma', 'Shiring', '01/01/2000', 'blank-profile-picture.png', '', false, 28),
                    (36, 2, 27, 'estiff@kipsu.com', '\"user\"', 'Kipsu123', 'Emily', 'Stiff', '01/01/2000', 'blank-profile-picture.png', '@Emily Stiff', true, 29),
                    (37, 1, 28, 'tanderson@kipsu.com', '\"user\"', 'Kipsu123', 'Tony', 'Anderson', '01/01/2000', 'blank-profile-picture.png', '@tanders', true, 28),                    
                    (38, 1, 24, 'atassadaq@kipsu.com', '\"user\"', 'Kipsu123', 'Aazib', 'Tassadaq', '01/01/2000', 'blank-profile-picture.png', '@Aazib Tassadaq', true, 30),                    
                    (39, 1, 57, 'nbath@kipsu.com', '\"user\"', 'Kipsu123', 'Nuru', 'Bath', '01/01/2000', 'blank-profile-picture.png', '@Nuru Bath', true, 31),                    
                    (40, 3, 23, 'mgasper@kipsu.com', '\"user\"', 'Kipsu123', 'Madeline', 'Gasper', '01/01/2000', 'blank-profile-picture.png', '@Madeline Gasper', false, 32),                    
                    (41, 2, 63, 'kswafford@kipsu.com', '\"user\"', 'Kipsu123', 'Keelie', 'Swafford', '01/01/2000', 'blank-profile-picture.png', '@Keelie Swafford', true, 32),                    
                    (42, 1, 65, 'gfusco@kipsu.com', '\"user\"', 'Kipsu123', 'Gavin', 'Fusco', '01/01/2000', 'blank-profile-picture.png', '@Gavin Fusco', true, 32),                    
                    (43, 1, 79, 'tmcgurran@kipsu.com', '\"user\"', 'Kipsu123', 'Tom', 'McGurran', '01/01/2000', 'blank-profile-picture.png', '@Tom McGurran', true, 33),                    
                    (44, 1, 78, 'jporter@kipsu.com', '\"user\"', 'Kipsu123', 'Justin', 'Porter', '01/01/2000', 'blank-profile-picture.png', '@Justin Porter', true, 34),                    
                    (45, 2, 46, 'ccheung@kipsu.com', '\"user\"', 'Kipsu123', 'Chanda', 'Cheung', '01/01/2000', 'blank-profile-picture.png', '@Chanda Cheung', true, 35),                    
                    (46, 1, 31, 'dstewart@kipsu.com', '\"user\"', 'Kipsu123', 'Doug', 'Stewart', '01/01/2000', 'blank-profile-picture.png', '@Doug Stewart', true, 61),                   
                    (47, 1, 76, 'danunti@kipsu.com', '\"user\"', 'Kipsu123', 'Drew', 'Anunti', '01/01/2000', 'blank-profile-picture.png', '@danunti', true, 36),                  
                    (48, 1, 36, 'hmickelson@kipsu.com', '\"user\"', 'Kipsu123', 'Hunter', 'Mickelson', '01/01/2000', 'blank-profile-picture.png', '@Hunter Mickelson', true, 37),                  
                    (49, 2, 37, 'kprostrollo@kipsu.com', '\"user\"', 'Kipsu123', 'Kate', 'Prostrollo', '01/01/2000', 'blank-profile-picture.png', '@kate', true, 37),                
                    (50, 1, 50, 'jschmidt@kipsu.com', '\"user\"', 'Kipsu123', 'Jake', 'Schmidt', '01/01/2000', 'blank-profile-picture.png', '@Jake Schmidt', true, 38),               
                    (51, 2, 49, 'jalderson@kipsu.com', '\"user\"', 'Kipsu123', 'Jenae', 'Alderson', '01/01/2000', 'blank-profile-picture.png', '@Jenae Alderson', true, 38),               
                    (52, 1, 48, 'pwitte@kipsu.com', '\"user\"', 'Kipsu123', 'Paul', 'Witte', '01/01/2000', 'blank-profile-picture.png', '@Paul Witte', true, 38),            
                    (53, 1, 38, 'rwest@kipsu.com', '\"user\"', 'Kipsu123', 'Rashad', 'West', '01/01/2000', 'blank-profile-picture.png', '@Rashad West', true, 38),            
                    (54, 1, 47, 'taubrecht@kipsu.com', '\"user\"', 'Kipsu123', 'TJ', 'Aubrecht', '01/01/2000', 'blank-profile-picture.png', '@TJ Aubrecht', true, 38),            
                    (55, 2, 35, 'sthomsen@kipsu.com', '\"user\"', 'Kipsu123', 'Sierra', 'Thomsen', '01/01/2000', 'blank-profile-picture.png', '@Sierra Thomsen', true, 38),            
                    (56, 1, 75, 'clehmann@kipsu.com', '\"user\"', 'Kipsu123', 'Charlie', 'Lehmann', '01/01/2000', 'blank-profile-picture.png', '@lehm0102', true, 39),            
                    (57, 1, 84, 'tshneider@kipsu.com', '\"user\"', 'Kipsu123', 'Todd', 'Shneider', '01/01/2000', 'blank-profile-picture.png', '@tshneider', true, 40),            
                    (58, 2, 86, 'asorenson@kipsu.com', '\"user\"', 'Kipsu123', 'Amber', 'Sorenson', '01/01/2000', 'blank-profile-picture.png', '@Amber Sorenson', true, 41),            
                    (59, 2, 17, 'imclaughlin@kipsu.com', '\"user\"', 'Kipsu123', 'Iloriem', 'McLaughlin', '01/01/2000', 'blank-profile-picture.png', '@Iloriem McLaughlin', true, 41),            
                    (60, 1, 85, 'gkrohn@kipsu.com', '\"user\"', 'Kipsu123', 'Garrett', 'Krohn', '01/01/2000', 'blank-profile-picture.png', '@Garrett Krohn', true, 41),            
                    (61, 2, 19, 'hkim@kipsu.com', '\"user\"', 'Kipsu123', 'Heather', 'Kim', '01/01/2000', 'blank-profile-picture.png', '@Heather Kim', true, 41),          
                    (62, 1, 20, 'nmathewson@kipsu.com', '\"user\"', 'Kipsu123', 'Nick', 'Mathewson', '01/01/2000', 'blank-profile-picture.png', '@Nick Mathewson', true, 42),          
                    (63, 2, 13, 'ecox@kipsu.com', '\"user\"', 'Kipsu123', 'Emily', 'Cox', '01/01/2000', 'blank-profile-picture.png', '@Emily Cox', true, 44),          
                    (64, 1, 14, 'jfrisch@kipsu.com', '\"user\"', 'Kipsu123', 'Jake', 'Frisch', '01/01/2000', 'blank-profile-picture.png', '@Jake Frisch', true, 43),          
                    (65, 1, 16, 'ntheis@kipsu.com', '\"user\"', 'Kipsu123', 'Noah', 'Theis', '01/01/2000', 'blank-profile-picture.png', '@Noah Theis', true, 43),          
                    (66, 1, 86, 'jbriones@kipsu.com', '\"user\"', 'Kipsu123', 'Jonny', 'Briones', '01/01/2000', 'blank-profile-picture.png', '@Noah Theis', true, 43),          
                    (67, 1, 11, 'ttrousdale@kipsu.com', '\"user\"', 'Kipsu123', 'Tony', 'Trousdale', '01/01/2000', 'blank-profile-picture.png', '@Tony Trousdale', true, 45),          
                    (68, 1, 30, 'ataylor@kipsu.com', '\"user\"', 'Kipsu123', 'Andrew', 'Taylor', '01/01/2000', 'blank-profile-picture.png', '@Andrew Taylor', true, 46),          
                    (69, 1, 29, 'cwelch@kipsu.com', '\"user\"', 'Kipsu123', 'Camilo', 'Welch', '01/01/2000', 'blank-profile-picture.png', '@Camilo Welch', true, 46),          
                    (70, 2, 87, 'gnussbaum@kipsu.com', '\"user\"', 'Kipsu123', 'Gretchen', 'Nussbaum', '01/01/2000', 'blank-profile-picture.png', '@Gretchen Nussbaum', true, 46),          
                    (71, 2, 12, 'jdreyling@kipsu.com', '\"user\"', 'Kipsu123', 'Jamie', 'Dreyling', '01/01/2000', 'blank-profile-picture.png', '@Jamie Dreyling', true, 46),          
                    (72, 2, 15, 'vquito@kipsu.com', '\"user\"', 'Kipsu123', 'Vilma', 'Quito', '01/01/2000', 'blank-profile-picture.png', '@Vilma Quito', true, 46),          
                    (73, 1, 9, 'jalter@kipsu.com', '\"user\"', 'Kipsu123', 'Jonathan', 'Alter', '01/01/2000', 'blank-profile-picture.png', '@Jonathan Alter', true, 47),          
                    (74, 1, 88, 'agorski@kipsu.com', '\"user\"', 'Kipsu123', 'Adam', 'Gorski', '01/01/2000', 'blank-profile-picture.png', '@Adam Gorski', true, 48),          
                    (75, 2, 7, 'kpierce@kipsu.com', '\"user\"', 'Kipsu123', 'Kayci', 'Pierce', '01/01/2000', 'blank-profile-picture.png', '@Kayci Pierce', true, 48),          
                    (76, 2, 5, 'kshilkrot@kipsu.com', '\"user\"', 'Kipsu123', 'Katie', 'Shilkrot', '01/01/2000', 'blank-profile-picture.png', '@Katie Shilkrot', true, 49),          
                    (77, 1, 6, 'nkroeger@kipsu.com', '\"user\"', 'Kipsu123', 'Nick', 'Kroeger', '01/01/2000', 'blank-profile-picture.png', '@Nick Kroeger', true, 49),          
                    (78, 2, 77, 'edixon@kipsu.com', '\"user\"', 'Kipsu123', 'Eva', 'Dixon', '01/01/2000', 'blank-profile-picture.png', '@eva', true, 50),          
                    (79, 2, 42, 'ccooper@kipsu.com', '\"user\"', 'Kipsu123', 'Carolyn', 'Cooper', '01/01/2000', 'blank-profile-picture.png', '@coop', true, 51),          
                    (80, 2, 89, 'lbeier@kipsu.com', '\"user\"', 'Kipsu123', 'Laura', 'Beier', '01/01/2000', 'blank-profile-picture.png', '@Laura Beier', true, 52),          
                    (81, 1, 40, 'msheeler@kipsu.com', '\"user\"', 'Kipsu123', 'Marcus', 'Sheeler', '01/01/2000', 'blank-profile-picture.png', '@Marcus', true, 53),          
                    (82, 2, 90, 'mgillett@kipsu.com', '\"user\"', 'Kipsu123', 'Megan', 'Gillett', '01/01/2000', 'blank-profile-picture.png', '@Megan Gillett', true, 54),          
                    (83, 1, 41, 'zbordeau@kipsu.com', '\"user\"', 'Kipsu123', 'Zach', 'Bordeau', '01/01/2000', 'blank-profile-picture.png', '@zach bordeau', true, 55),          
                    (84, 1, 33, 'bjacobson@kipsu.com', '\"user\"', 'Kipsu123', 'Brain', 'Jacobson', '01/01/2000', 'blank-profile-picture.png', '@Brian Jacobson', true, 56),          
                    (85, 1, 43, 'mrode@kipsu.com', '\"user\"', 'Kipsu123', 'Matt', 'Rode', '01/01/2000', 'blank-profile-picture.png', '@matt_rode', true, 57),          
                    (86, 2, 32, 'abartlett@kipsu.com', '\"user\"', 'Kipsu123', 'Abby', 'Bartlett', '01/01/2000', 'blank-profile-picture.png', '@Abby Bartlett', true, 58),          
                    (87, 1, 91, 'kfinger@kipsu.com', '\"user\"', 'Kipsu123', 'Kevin', 'Finger', '01/01/2000', 'blank-profile-picture.png', '@Kevin Finger', true, 59),          
                    (88, 1, 44, 'tmoua@kipsu.com', '\"user\"', 'Kipsu123', 'Tré', 'Moua', '01/01/2000', 'blank-profile-picture.png', '@Tré Moua', true, 60);          
        ");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("
            DELETE FROM \"user\";
        ");
    }
}