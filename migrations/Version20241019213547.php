<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241019213547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room_img ADD room_id INT DEFAULT NULL, CHANGE room image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE room_img ADD CONSTRAINT FK_B94475B154177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('CREATE INDEX IDX_B94475B154177093 ON room_img (room_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room_img DROP FOREIGN KEY FK_B94475B154177093');
        $this->addSql('DROP INDEX IDX_B94475B154177093 ON room_img');
        $this->addSql('ALTER TABLE room_img DROP room_id, CHANGE image_name room VARCHAR(255) DEFAULT NULL');
    }
}
