<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241020113547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE room_img (id INT AUTO_INCREMENT NOT NULL, room_id INT DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, INDEX IDX_B94475B154177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE room_img ADD CONSTRAINT FK_B94475B154177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE room DROP image');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room_img DROP FOREIGN KEY FK_B94475B154177093');
        $this->addSql('DROP TABLE room_img');
        $this->addSql('ALTER TABLE room ADD image VARCHAR(255) DEFAULT NULL');
    }
}
