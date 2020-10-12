<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201009092616 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE minus (id INT AUTO_INCREMENT NOT NULL, feld DOUBLE PRECISION DEFAULT NULL, zahlminus DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nic_api_view (id INT AUTO_INCREMENT NOT NULL, input VARCHAR(255) DEFAULT NULL, output LONGTEXT NOT NULL, ngrok_url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nic_api_view_version2 (id INT AUTO_INCREMENT NOT NULL, input VARCHAR(255) DEFAULT NULL, output LONGTEXT NOT NULL, ngrok_url VARCHAR(255) NOT NULL, `delete` INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plus (id INT AUTO_INCREMENT NOT NULL, zahl_plus DOUBLE PRECISION DEFAULT NULL, feld_plus DOUBLE PRECISION DEFAULT NULL, attending TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rechner (id INT AUTO_INCREMENT NOT NULL, zahl DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rest (id INT AUTO_INCREMENT NOT NULL, min_zahl NUMERIC(10, 0) DEFAULT NULL, max_zahl NUMERIC(10, 0) NOT NULL, random_number NUMERIC(10, 0) NOT NULL, text NUMERIC(10, 0) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE minus');
        $this->addSql('DROP TABLE nic_api_view');
        $this->addSql('DROP TABLE nic_api_view_version2');
        $this->addSql('DROP TABLE plus');
        $this->addSql('DROP TABLE rechner');
        $this->addSql('DROP TABLE rest');
    }
}
