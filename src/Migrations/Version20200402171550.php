<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200402171550 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, code INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE visiter');
        $this->addSql('ALTER TABLE appartement ADD villes_id INT DEFAULT NULL, CHANGE ADR ADR CHAR(255) DEFAULT \'NULL\', CHANGE CP CP SMALLINT DEFAULT NULL, CHANGE filename filename VARCHAR(255) NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('CREATE INDEX IDX_71A6BD8D286C17BC ON appartement (villes_id)');
        }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appartement DROP FOREIGN KEY FK_71A6BD8D286C17BC');
        $this->addSql('DROP TABLE ville');
        $this->addSql('ALTER TABLE appartement DROP FOREIGN KEY FK_71A6BD8D2D650C09');
        $this->addSql('DROP INDEX IDX_71A6BD8D286C17BC ON appartement');
        $this->addSql('ALTER TABLE appartement DROP villes_id, CHANGE ADR ADR CHAR(32) CHARACTER SET latin1 DEFAULT \'NULL\' COLLATE `latin1_swedish_ci`, CHANGE CP CP INT DEFAULT NULL, CHANGE filename filename VARCHAR(255) CHARACTER SET latin1 DEFAULT \'NULL\' COLLATE `latin1_swedish_ci`, CHANGE updated_at updated_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        }
}
