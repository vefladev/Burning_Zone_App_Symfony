<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200324112353 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8F3C105691');
        $this->addSql('DROP INDEX IDX_D5128A8F3C105691 ON training');
        $this->addSql('ALTER TABLE training ADD started_at DATETIME NOT NULL, ADD ended_at DATETIME NOT NULL, DROP content, DROP picture, CHANGE coach_id coach_training_id INT NOT NULL');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8F9A27C600 FOREIGN KEY (coach_training_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D5128A8F9A27C600 ON training (coach_training_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8F9A27C600');
        $this->addSql('DROP INDEX IDX_D5128A8F9A27C600 ON training');
        $this->addSql('ALTER TABLE training ADD content LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD picture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP started_at, DROP ended_at, CHANGE coach_training_id coach_id INT NOT NULL');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8F3C105691 FOREIGN KEY (coach_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D5128A8F3C105691 ON training (coach_id)');
    }
}
