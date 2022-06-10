<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220512081914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie ADD img LONGTEXT NOT NULL, CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE question ADD categorie_id INT NOT NULL, DROP id_categorie, CHANGE question question VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494EBCF5E72D ON question (categorie_id)');
        $this->addSql('ALTER TABLE reponse ADD question_id INT NOT NULL, DROP id_question, CHANGE reponse reponse VARCHAR(255) NOT NULL, CHANGE reponse_expected reponse_expected INT NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC71E27F6BF ON reponse (question_id)');
        $this->addSql('ALTER TABLE user CHANGE updateat updateat DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE createat createat DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP img, CHANGE name name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EBCF5E72D');
        $this->addSql('DROP INDEX IDX_B6F7494EBCF5E72D ON question');
        $this->addSql('ALTER TABLE question ADD id_categorie INT DEFAULT NULL, DROP categorie_id, CHANGE question question VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC71E27F6BF');
        $this->addSql('DROP INDEX IDX_5FB6DEC71E27F6BF ON reponse');
        $this->addSql('ALTER TABLE reponse ADD id_question INT DEFAULT NULL, DROP question_id, CHANGE reponse reponse VARCHAR(255) DEFAULT NULL, CHANGE reponse_expected reponse_expected TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` CHANGE updateat updateat DATETIME DEFAULT NULL, CHANGE createat createat DATETIME NOT NULL');
    }
}
