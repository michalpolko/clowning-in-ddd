<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230906224223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_article (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(150) NOT NULL, content MEDIUMTEXT NOT NULL, is_draft TINYINT(1) NOT NULL, INDEX IDX_EECCB3E512469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_article_rating (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', rating INT NOT NULL, added_by_ip VARCHAR(15) NOT NULL, added_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_F6391A1B7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(100) NOT NULL, INDEX IDX_72113DE6727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_article ADD CONSTRAINT FK_EECCB3E512469DE2 FOREIGN KEY (category_id) REFERENCES blog_category (id)');
        $this->addSql('ALTER TABLE blog_article_rating ADD CONSTRAINT FK_F6391A1B7294869C FOREIGN KEY (article_id) REFERENCES blog_article (id)');
        $this->addSql('ALTER TABLE blog_category ADD CONSTRAINT FK_72113DE6727ACA70 FOREIGN KEY (parent_id) REFERENCES blog_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_article DROP FOREIGN KEY FK_EECCB3E512469DE2');
        $this->addSql('ALTER TABLE blog_article_rating DROP FOREIGN KEY FK_F6391A1B7294869C');
        $this->addSql('ALTER TABLE blog_category DROP FOREIGN KEY FK_72113DE6727ACA70');
        $this->addSql('DROP TABLE blog_article');
        $this->addSql('DROP TABLE blog_article_rating');
        $this->addSql('DROP TABLE blog_category');
    }
}
