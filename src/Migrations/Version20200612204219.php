<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612204219 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A7941003F');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77847941003F');
        $this->addSql('ALTER TABLE region_bird DROP FOREIGN KEY FK_791DB939E813F9');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784E813F9');
        $this->addSql('ALTER TABLE birds DROP FOREIGN KEY FK_FC1659A22A86559F');
        $this->addSql('ALTER TABLE birds DROP FOREIGN KEY FK_FC1659A21463FA3A');
        $this->addSql('ALTER TABLE region_bird DROP FOREIGN KEY FK_791DB93998260155');
        $this->addSql('ALTER TABLE points DROP FOREIGN KEY FK_27BA8E294BD2A4C0');
        $this->addSql('CREATE TABLE train (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, carr_ct INT NOT NULL, place_ct INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, schedule_id INT DEFAULT NULL, user_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_97A0ADA3A40BC2D5 (schedule_id), INDEX IDX_97A0ADA3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedule (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, train_id INT DEFAULT NULL, movedate DATE NOT NULL, INDEX IDX_5A3811FB64D218E (location_id), INDEX IDX_5A3811FB23BCD4D0 (train_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3A40BC2D5 FOREIGN KEY (schedule_id) REFERENCES schedule (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB23BCD4D0 FOREIGN KEY (train_id) REFERENCES train (id)');
        $this->addSql('DROP TABLE analysis');
        $this->addSql('DROP TABLE birds');
        $this->addSql('DROP TABLE classification');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE eco_group');
        $this->addSql('DROP TABLE points');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE region_bird');
        $this->addSql('DROP TABLE report');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB23BCD4D0');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB64D218E');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3A40BC2D5');
        $this->addSql('CREATE TABLE analysis (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, theme VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, map VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_33C730A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE birds (id INT AUTO_INCREMENT NOT NULL, eco_group_id INT DEFAULT NULL, classification_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_FC1659A21463FA3A (eco_group_id), INDEX IDX_FC1659A22A86559F (classification_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE classification (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, characteristic LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, analysis_id INT DEFAULT NULL, comment VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5F9E962A7941003F (analysis_id), INDEX IDX_5F9E962AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE eco_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE points (id INT AUTO_INCREMENT NOT NULL, report_id INT DEFAULT NULL, point_x DOUBLE PRECISION NOT NULL, point_y DOUBLE PRECISION NOT NULL, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_27BA8E294BD2A4C0 (report_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, area DOUBLE PRECISION NOT NULL, point_x DOUBLE PRECISION NOT NULL, point_y DOUBLE PRECISION NOT NULL, polygon LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, climate TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, soil_char TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, animal_char TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, plants_char TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE region_bird (id INT AUTO_INCREMENT NOT NULL, bird_id INT DEFAULT NULL, region_id INT DEFAULT NULL, population INT NOT NULL, point_x DOUBLE PRECISION NOT NULL, point_y DOUBLE PRECISION NOT NULL, INDEX IDX_791DB93998260155 (region_id), INDEX IDX_791DB939E813F9 (bird_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, bird_id INT DEFAULT NULL, analysis_id INT DEFAULT NULL, theme VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, document VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_C42F77847941003F (analysis_id), INDEX IDX_C42F7784E813F9 (bird_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE analysis ADD CONSTRAINT FK_33C730A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE birds ADD CONSTRAINT FK_FC1659A21463FA3A FOREIGN KEY (eco_group_id) REFERENCES eco_group (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE birds ADD CONSTRAINT FK_FC1659A22A86559F FOREIGN KEY (classification_id) REFERENCES classification (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A7941003F FOREIGN KEY (analysis_id) REFERENCES analysis (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE points ADD CONSTRAINT FK_27BA8E294BD2A4C0 FOREIGN KEY (report_id) REFERENCES report (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE region_bird ADD CONSTRAINT FK_791DB93998260155 FOREIGN KEY (region_id) REFERENCES region (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE region_bird ADD CONSTRAINT FK_791DB939E813F9 FOREIGN KEY (bird_id) REFERENCES birds (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77847941003F FOREIGN KEY (analysis_id) REFERENCES analysis (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784E813F9 FOREIGN KEY (bird_id) REFERENCES birds (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE train');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE schedule');
    }
}
