<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261015130445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement ADD COLUMN statut INTEGER NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__evenement AS SELECT id, titre, date, informations, categorie, place_number, picture FROM evenement');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('CREATE TABLE evenement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, date DATETIME NOT NULL, informations VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, place_number INTEGER NOT NULL, picture VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO evenement (id, titre, date, informations, categorie, place_number, picture) SELECT id, titre, date, informations, categorie, place_number, picture FROM __temp__evenement');
        $this->addSql('DROP TABLE __temp__evenement');
    }
}
