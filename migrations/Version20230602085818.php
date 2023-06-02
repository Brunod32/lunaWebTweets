<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230602085818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, avatar_id INT DEFAULT NULL, screen_name VARCHAR(13) NOT NULL, full_name VARCHAR(14) NOT NULL, uid INT NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_BDAFD8C886383B10 (avatar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avatar (id INT AUTO_INCREMENT NOT NULL, large LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publications (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(10) NOT NULL, uid BIGINT NOT NULL, url VARCHAR(255) NOT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, content LONGTEXT NOT NULL, published_at VARCHAR(255) DEFAULT NULL, images LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', source LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', author LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source (id INT AUTO_INCREMENT NOT NULL, settings_id VARCHAR(13) NOT NULL, type VARCHAR(12) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE author ADD CONSTRAINT FK_BDAFD8C886383B10 FOREIGN KEY (avatar_id) REFERENCES avatar (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author DROP FOREIGN KEY FK_BDAFD8C886383B10');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE publications');
        $this->addSql('DROP TABLE source');
    }
}
