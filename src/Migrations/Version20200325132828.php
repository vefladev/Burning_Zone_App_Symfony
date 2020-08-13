<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200325132828 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE training_user');
        $this->addSql('ALTER TABLE training ADD user_training_id INT DEFAULT NULL, ADD user_nom_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8F17E65144 FOREIGN KEY (user_training_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8FAD4007D4 FOREIGN KEY (user_nom_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5128A8F17E65144 ON training (user_training_id)');
        $this->addSql('CREATE INDEX IDX_D5128A8FAD4007D4 ON training (user_nom_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE training_user (training_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8209910AA76ED395 (user_id), INDEX IDX_8209910ABEFD98D1 (training_id), PRIMARY KEY(training_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE training_user ADD CONSTRAINT FK_8209910AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training_user ADD CONSTRAINT FK_8209910ABEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8F17E65144');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8FAD4007D4');
        $this->addSql('DROP INDEX UNIQ_D5128A8F17E65144 ON training');
        $this->addSql('DROP INDEX IDX_D5128A8FAD4007D4 ON training');
        $this->addSql('ALTER TABLE training DROP user_training_id, DROP user_nom_id');
    }
}
