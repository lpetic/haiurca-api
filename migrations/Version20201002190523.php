<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201002190523 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cities (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_D95DB16BF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE countries (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travels (id INT AUTO_INCREMENT NOT NULL, origin_id INT NOT NULL, destination_id INT NOT NULL, user_id INT NOT NULL, go DATETIME NOT NULL, back DATETIME DEFAULT NULL, price INT DEFAULT NULL, description VARCHAR(1000) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_67FF2BD756A273CC (origin_id), INDEX IDX_67FF2BD7816C6140 (destination_id), INDEX IDX_67FF2BD7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cities ADD CONSTRAINT FK_D95DB16BF92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE travels ADD CONSTRAINT FK_67FF2BD756A273CC FOREIGN KEY (origin_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE travels ADD CONSTRAINT FK_67FF2BD7816C6140 FOREIGN KEY (destination_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE travels ADD CONSTRAINT FK_67FF2BD7A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE travels DROP FOREIGN KEY FK_67FF2BD756A273CC');
        $this->addSql('ALTER TABLE travels DROP FOREIGN KEY FK_67FF2BD7816C6140');
        $this->addSql('ALTER TABLE cities DROP FOREIGN KEY FK_D95DB16BF92F3E70');
        $this->addSql('ALTER TABLE travels DROP FOREIGN KEY FK_67FF2BD7A76ED395');
        $this->addSql('DROP TABLE cities');
        $this->addSql('DROP TABLE countries');
        $this->addSql('DROP TABLE travels');
        $this->addSql('DROP TABLE users');
    }
}
