<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507174838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prispevek (id INT AUTO_INCREMENT NOT NULL, autor_id INT NOT NULL, nazev VARCHAR(255) NOT NULL, obsah LONGTEXT NOT NULL, obrazek1 VARCHAR(255) DEFAULT NULL, obrazek2 VARCHAR(255) DEFAULT NULL, obrazek3 VARCHAR(255) DEFAULT NULL, obrazek4 VARCHAR(255) DEFAULT NULL, obrazek5 VARCHAR(255) DEFAULT NULL, datum_vytvoreni DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', slug VARCHAR(255) NOT NULL, INDEX IDX_CFBE3E114D45BBE (autor_id), UNIQUE INDEX UNIQ_IDENTIFIER_SLUG (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_heslo (id INT AUTO_INCREMENT NOT NULL, uzivatel_id INT NOT NULL, kod VARCHAR(255) NOT NULL, datum_vytvoreni DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_A9953FE99B3651C6 (uzivatel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE uzivatel (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, jmeno VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prispevek ADD CONSTRAINT FK_CFBE3E114D45BBE FOREIGN KEY (autor_id) REFERENCES uzivatel (id)');
        $this->addSql('ALTER TABLE reset_heslo ADD CONSTRAINT FK_A9953FE99B3651C6 FOREIGN KEY (uzivatel_id) REFERENCES uzivatel (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prispevek DROP FOREIGN KEY FK_CFBE3E114D45BBE');
        $this->addSql('ALTER TABLE reset_heslo DROP FOREIGN KEY FK_A9953FE99B3651C6');
        $this->addSql('DROP TABLE prispevek');
        $this->addSql('DROP TABLE reset_heslo');
        $this->addSql('DROP TABLE uzivatel');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
