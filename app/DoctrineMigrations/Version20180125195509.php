<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180125195509 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, notebook INT DEFAULT NULL, name VARCHAR(100) NOT NULL, content VARCHAR(500) NOT NULL, enabled TINYINT(1) NOT NULL, INDEX IDX_CFBDFA14F67D9A2B (notebook), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT NOT NULL, name VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notebook (id INT AUTO_INCREMENT NOT NULL, user INT DEFAULT NULL, type INT DEFAULT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(500) NOT NULL, enabled TINYINT(1) NOT NULL, INDEX IDX_F67D9A2B8D93D649 (user), INDEX IDX_F67D9A2B8CDE5729 (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14F67D9A2B FOREIGN KEY (notebook) REFERENCES notebook (id)');
        $this->addSql('ALTER TABLE notebook ADD CONSTRAINT FK_F67D9A2B8D93D649 FOREIGN KEY (user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE notebook ADD CONSTRAINT FK_F67D9A2B8CDE5729 FOREIGN KEY (type) REFERENCES type (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE notebook DROP FOREIGN KEY FK_F67D9A2B8CDE5729');
        $this->addSql('ALTER TABLE notebook DROP FOREIGN KEY FK_F67D9A2B8D93D649');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14F67D9A2B');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE notebook');
    }
}
