<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230908225703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE domain_event (uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', aggregate_root_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', aggregate_root_fqcn VARCHAR(255) NOT NULL, event_data JSON NOT NULL, version INT NOT NULL, INDEX idx_domain_event_aggregate_root_fqcn_id (aggregate_root_fqcn, aggregate_root_id), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE domain_event');
    }
}
