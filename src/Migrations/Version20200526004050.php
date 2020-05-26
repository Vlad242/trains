<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200526004050 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE points DROP FOREIGN KEY FK_27BA8E2953C55F64');
        $this->addSql('DROP TABLE map');
        $this->addSql('ALTER TABLE analysis ADD image VARCHAR(255) NOT NULL, ADD map VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE points DROP FOREIGN KEY FK_27BA8E297E7F0B73');
        $this->addSql('DROP INDEX IDX_27BA8E2953C55F64 ON points');
        $this->addSql('DROP INDEX IDX_27BA8E297E7F0B73 ON points');
        $this->addSql('ALTER TABLE points ADD report_id INT DEFAULT NULL, DROP map_id, DROP analisys_id');
        $this->addSql('ALTER TABLE points ADD CONSTRAINT FK_27BA8E294BD2A4C0 FOREIGN KEY (report_id) REFERENCES report (id)');
        $this->addSql('CREATE INDEX IDX_27BA8E294BD2A4C0 ON points (report_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE map (id INT AUTO_INCREMENT NOT NULL, map_path VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE analysis DROP image, DROP map');
        $this->addSql('ALTER TABLE points DROP FOREIGN KEY FK_27BA8E294BD2A4C0');
        $this->addSql('DROP INDEX IDX_27BA8E294BD2A4C0 ON points');
        $this->addSql('ALTER TABLE points ADD analisys_id INT DEFAULT NULL, CHANGE report_id map_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE points ADD CONSTRAINT FK_27BA8E2953C55F64 FOREIGN KEY (map_id) REFERENCES map (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE points ADD CONSTRAINT FK_27BA8E297E7F0B73 FOREIGN KEY (analisys_id) REFERENCES analysis (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_27BA8E2953C55F64 ON points (map_id)');
        $this->addSql('CREATE INDEX IDX_27BA8E297E7F0B73 ON points (analisys_id)');
    }
}
