<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231004145449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wish ADD subject_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE wish ADD CONSTRAINT FK_D7D174C96ED75F8F FOREIGN KEY (subject_id_id) REFERENCES subject (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D7D174C96ED75F8F ON wish (subject_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE wish DROP CONSTRAINT FK_D7D174C96ED75F8F');
        $this->addSql('DROP INDEX IDX_D7D174C96ED75F8F');
        $this->addSql('ALTER TABLE wish DROP subject_id_id');
    }
}
