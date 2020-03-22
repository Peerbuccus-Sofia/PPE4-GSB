<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200318151901 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appartement CHANGE CP CP INTEGER DEFAULT NULL, CHANGE FILENAME filename VARCHAR(255) NULL');
        $this->addSql('ALTER TABLE admin CHANGE ROLE ROLE JSON DEFAULT \'ROLE_ADMIN\', CHANGE PASSWORD PASSWORD CHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE locataire CHANGE DATENAISSANCE DATENAISSANCE CHAR(32) DEFAULT \'NULL\', CHANGE ROLE ROLE JSON DEFAULT \'ROLE_LOC\', CHANGE USERNAME USERNAME CHAR(32) DEFAULT \'NULL\', CHANGE PASSWORD PASSWORD CHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE proprietaire DROP ROLE, CHANGE PASSWORD PASSWORD CHAR(255)');
        $this->addSql('ALTER TABLE visiteur CHANGE ROLE ROLE JSON DEFAULT \'ROLE_VISITEUR\', CHANGE USERNAME USERNAME CHAR(255) DEFAULT NULL, CHANGE PASSWORD PASSWORD CHAR(255) DEFAULT \'NULL\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin CHANGE PASSWORD PASSWORD VARCHAR(255) CHARACTER SET latin1 DEFAULT \'NULL\' COLLATE `latin1_swedish_ci`, CHANGE ROLE ROLE LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE appartement DROP FOREIGN KEY FK_71A6BD8D2D650C09');
        $this->addSql('ALTER TABLE appartement CHANGE CP CP INT DEFAULT NULL, CHANGE filename FILENAME VARCHAR(255) CHARACTER SET latin1 DEFAULT \'NULL\' COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE appartement RENAME INDEX i_fk_appartement_proprietaire TO FK_APPARTEMENT_PROPRIETAIRE');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5CA3CE735');
        $this->addSql('ALTER TABLE locataire DROP FOREIGN KEY FK_C47CF6EB3217A767');
        $this->addSql('ALTER TABLE locataire CHANGE DATENAISSANCE DATENAISSANCE DATETIME DEFAULT \'NULL\', CHANGE USERNAME USERNAME VARCHAR(55) CHARACTER SET latin1 DEFAULT \'NULL\' COLLATE `latin1_swedish_ci`, CHANGE PASSWORD PASSWORD VARCHAR(255) CHARACTER SET latin1 DEFAULT \'NULL\' COLLATE `latin1_swedish_ci`, CHANGE ROLE ROLE LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE proprietaire ADD ROLE LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE PASSWORD PASSWORD VARCHAR(255) CHARACTER SET latin1 DEFAULT \'NULL\' COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE visiteur CHANGE USERNAME USERNAME CHAR(255) CHARACTER SET latin1 DEFAULT \'NULL\' COLLATE `latin1_swedish_ci`, CHANGE PASSWORD PASSWORD CHAR(255) CHARACTER SET latin1 DEFAULT \'\'\'NULL\'\'\' COLLATE `latin1_swedish_ci`, CHANGE ROLE ROLE LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`');
    }
}
