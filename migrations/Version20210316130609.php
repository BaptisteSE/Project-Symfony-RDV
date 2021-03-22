<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210316130609 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assistant (id INT AUTO_INCREMENT NOT NULL, medecin_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, INDEX IDX_C2997CD14F31A84 (medecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, datedemande DATE NOT NULL, heuredemande TIME NOT NULL, etat VARCHAR(255) NOT NULL, INDEX IDX_2694D7A56B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecin (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecin_demande (medecin_id INT NOT NULL, demande_id INT NOT NULL, INDEX IDX_58BD12984F31A84 (medecin_id), INDEX IDX_58BD129880E95E18 (demande_id), PRIMARY KEY(medecin_id, demande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, assistant_id INT DEFAULT NULL, medecin_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, identifiant VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), UNIQUE INDEX UNIQ_1D1C63B36B899279 (patient_id), UNIQUE INDEX UNIQ_1D1C63B3E05387EF (assistant_id), UNIQUE INDEX UNIQ_1D1C63B34F31A84 (medecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assistant ADD CONSTRAINT FK_C2997CD14F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A56B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE medecin_demande ADD CONSTRAINT FK_58BD12984F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medecin_demande ADD CONSTRAINT FK_58BD129880E95E18 FOREIGN KEY (demande_id) REFERENCES demande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B36B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3E05387EF FOREIGN KEY (assistant_id) REFERENCES assistant (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B34F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3E05387EF');
        $this->addSql('ALTER TABLE medecin_demande DROP FOREIGN KEY FK_58BD129880E95E18');
        $this->addSql('ALTER TABLE assistant DROP FOREIGN KEY FK_C2997CD14F31A84');
        $this->addSql('ALTER TABLE medecin_demande DROP FOREIGN KEY FK_58BD12984F31A84');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B34F31A84');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A56B899279');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B36B899279');
        $this->addSql('DROP TABLE assistant');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE medecin_demande');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE utilisateur');
    }
}
