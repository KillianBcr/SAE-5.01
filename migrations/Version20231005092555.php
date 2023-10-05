<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231005092555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nb_group_subject DROP CONSTRAINT fk_1ce597948aaa5016');
        $this->addSql('ALTER TABLE nb_group_subject DROP CONSTRAINT fk_1ce5979423edc87');
        $this->addSql('ALTER TABLE nb_group_group DROP CONSTRAINT fk_e0d6d7488aaa5016');
        $this->addSql('ALTER TABLE nb_group_group DROP CONSTRAINT fk_e0d6d748fe54d947');
        $this->addSql('DROP TABLE nb_group_subject');
        $this->addSql('DROP TABLE nb_group_group');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE nb_group_subject (nb_group_id INT NOT NULL, subject_id INT NOT NULL, PRIMARY KEY(nb_group_id, subject_id))');
        $this->addSql('CREATE INDEX idx_1ce5979423edc87 ON nb_group_subject (subject_id)');
        $this->addSql('CREATE INDEX idx_1ce597948aaa5016 ON nb_group_subject (nb_group_id)');
        $this->addSql('CREATE TABLE nb_group_group (nb_group_id INT NOT NULL, group_id INT NOT NULL, PRIMARY KEY(nb_group_id, group_id))');
        $this->addSql('CREATE INDEX idx_e0d6d748fe54d947 ON nb_group_group (group_id)');
        $this->addSql('CREATE INDEX idx_e0d6d7488aaa5016 ON nb_group_group (nb_group_id)');
        $this->addSql('ALTER TABLE nb_group_subject ADD CONSTRAINT fk_1ce597948aaa5016 FOREIGN KEY (nb_group_id) REFERENCES nbgroups (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nb_group_subject ADD CONSTRAINT fk_1ce5979423edc87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nb_group_group ADD CONSTRAINT fk_e0d6d7488aaa5016 FOREIGN KEY (nb_group_id) REFERENCES nbgroups (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nb_group_group ADD CONSTRAINT fk_e0d6d748fe54d947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
