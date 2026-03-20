<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260320134133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE event ADD id_categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA79F34925F FOREIGN KEY (id_categorie_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA79F34925F ON event (id_categorie_id)');
        $this->addSql('ALTER TABLE reservation RENAME INDEX idx_62894749a76ed395 TO IDX_42C84955A76ED395');
        $this->addSql('ALTER TABLE reservation RENAME INDEX idx_6289474971f7e88b TO IDX_42C8495571F7E88B');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categories');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA79F34925F');
        $this->addSql('DROP INDEX IDX_3BAE0AA79F34925F ON event');
        $this->addSql('ALTER TABLE event DROP id_categorie_id');
        $this->addSql('ALTER TABLE reservation RENAME INDEX idx_42c8495571f7e88b TO IDX_6289474971F7E88B');
        $this->addSql('ALTER TABLE reservation RENAME INDEX idx_42c84955a76ed395 TO IDX_62894749A76ED395');
    }
}
