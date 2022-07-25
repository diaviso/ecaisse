<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704161529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE decadaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, debut DATE NOT NULL, fin DATE NOT NULL, etat TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche (id INT AUTO_INCREMENT NOT NULL, decadaire_id INT NOT NULL, type_id INT NOT NULL, date DATE NOT NULL, nombre INT NOT NULL, INDEX IDX_4C13CC7840BB9EC8 (decadaire_id), INDEX IDX_4C13CC78C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, valeur INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC7840BB9EC8 FOREIGN KEY (decadaire_id) REFERENCES decadaire (id)');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78C54C8C93 FOREIGN KEY (type_id) REFERENCES ticket (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC7840BB9EC8');
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78C54C8C93');
        $this->addSql('DROP TABLE decadaire');
        $this->addSql('DROP TABLE fiche');
        $this->addSql('DROP TABLE ticket');
    }
}
