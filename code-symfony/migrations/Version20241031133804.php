<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241031133804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service CHANGE categorie_principale categorie_principale VARCHAR(100) DEFAULT NULL, CHANGE sous_categorie1 sous_categorie1 VARCHAR(100) DEFAULT NULL, CHANGE sous_categorie2 sous_categorie2 VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service CHANGE categorie_principale categorie_principale VARCHAR(100) NOT NULL, CHANGE sous_categorie1 sous_categorie1 VARCHAR(100) NOT NULL, CHANGE sous_categorie2 sous_categorie2 VARCHAR(100) NOT NULL');
    }
}
