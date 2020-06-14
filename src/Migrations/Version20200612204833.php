<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612204833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB64D218E');
        $this->addSql('DROP INDEX IDX_5A3811FB64D218E ON schedule');
        $this->addSql('ALTER TABLE schedule ADD location_to_id INT DEFAULT NULL, CHANGE location_id location_from_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB968BCAAF FOREIGN KEY (location_from_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB46690F40 FOREIGN KEY (location_to_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_5A3811FB968BCAAF ON schedule (location_from_id)');
        $this->addSql('CREATE INDEX IDX_5A3811FB46690F40 ON schedule (location_to_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB968BCAAF');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB46690F40');
        $this->addSql('DROP INDEX IDX_5A3811FB968BCAAF ON schedule');
        $this->addSql('DROP INDEX IDX_5A3811FB46690F40 ON schedule');
        $this->addSql('ALTER TABLE schedule ADD location_id INT DEFAULT NULL, DROP location_from_id, DROP location_to_id');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB64D218E FOREIGN KEY (location_id) REFERENCES location (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5A3811FB64D218E ON schedule (location_id)');
    }
}
