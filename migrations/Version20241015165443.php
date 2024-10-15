<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241015165443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD check_in_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD check_out_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE room DROP check_in_at, DROP check_out_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP check_in_at, DROP check_out_at');
        $this->addSql('ALTER TABLE room ADD check_in_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD check_out_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
