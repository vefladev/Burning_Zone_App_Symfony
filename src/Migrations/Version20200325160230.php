<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200325160230 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8F17E65144');
        $this->addSql('DROP INDEX UNIQ_D5128A8F17E65144 ON training');
        $this->addSql('ALTER TABLE training DROP user_training_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE training ADD user_training_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8F17E65144 FOREIGN KEY (user_training_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5128A8F17E65144 ON training (user_training_id)');
    }
}
