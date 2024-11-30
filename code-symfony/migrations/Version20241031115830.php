<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241031115830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, texte VARCHAR(255) NOT NULL, date_commentaire DATETIME NOT NULL, nom_expediteur VARCHAR(100) NOT NULL, valide TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modification (id INT AUTO_INCREMENT NOT NULL, id_admin_id INT NOT NULL, service_id INT DEFAULT NULL, photo_id INT DEFAULT NULL, date_modification DATETIME NOT NULL, commentaire VARCHAR(255) NOT NULL, INDEX IDX_EF6425D234F06E85 (id_admin_id), INDEX IDX_EF6425D2ED5CA9E6 (service_id), INDEX IDX_EF6425D27E9E4C8C (photo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, service_id INT NOT NULL, categorie_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_14B78418ED5CA9E6 (service_id), INDEX IDX_14B78418BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, categorie_principale VARCHAR(100) NOT NULL, sous_categorie1 VARCHAR(100) NOT NULL, sous_categorie2 VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE verification (id INT AUTO_INCREMENT NOT NULL, id_admin_id INT NOT NULL, commentaire_id INT DEFAULT NULL, statut VARCHAR(50) NOT NULL, date_verification DATETIME NOT NULL, INDEX IDX_5AF1C50B34F06E85 (id_admin_id), UNIQUE INDEX UNIQ_5AF1C50BBA9CD190 (commentaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE modification ADD CONSTRAINT FK_EF6425D234F06E85 FOREIGN KEY (id_admin_id) REFERENCES `admin` (id)');
        $this->addSql('ALTER TABLE modification ADD CONSTRAINT FK_EF6425D2ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE modification ADD CONSTRAINT FK_EF6425D27E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE verification ADD CONSTRAINT FK_5AF1C50B34F06E85 FOREIGN KEY (id_admin_id) REFERENCES `admin` (id)');
        $this->addSql('ALTER TABLE verification ADD CONSTRAINT FK_5AF1C50BBA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modification DROP FOREIGN KEY FK_EF6425D234F06E85');
        $this->addSql('ALTER TABLE modification DROP FOREIGN KEY FK_EF6425D2ED5CA9E6');
        $this->addSql('ALTER TABLE modification DROP FOREIGN KEY FK_EF6425D27E9E4C8C');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418ED5CA9E6');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418BCF5E72D');
        $this->addSql('ALTER TABLE verification DROP FOREIGN KEY FK_5AF1C50B34F06E85');
        $this->addSql('ALTER TABLE verification DROP FOREIGN KEY FK_5AF1C50BBA9CD190');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE modification');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE verification');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
