<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231005094158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nb_group_group (nb_group_id INT NOT NULL, group_id INT NOT NULL, PRIMARY KEY(nb_group_id, group_id))');
        $this->addSql('CREATE INDEX IDX_E0D6D7488AAA5016 ON nb_group_group (nb_group_id)');
        $this->addSql('CREATE INDEX IDX_E0D6D748FE54D947 ON nb_group_group (group_id)');
        $this->addSql('CREATE TABLE nb_group_subject (nb_group_id INT NOT NULL, subject_id INT NOT NULL, PRIMARY KEY(nb_group_id, subject_id))');
        $this->addSql('CREATE INDEX IDX_1CE597948AAA5016 ON nb_group_subject (nb_group_id)');
        $this->addSql('CREATE INDEX IDX_1CE5979423EDC87 ON nb_group_subject (subject_id)');
        $this->addSql('CREATE TABLE subject_nb_group (subject_id INT NOT NULL, nb_group_id INT NOT NULL, PRIMARY KEY(subject_id, nb_group_id))');
        $this->addSql('CREATE INDEX IDX_D22D79BE23EDC87 ON subject_nb_group (subject_id)');
        $this->addSql('CREATE INDEX IDX_D22D79BE8AAA5016 ON subject_nb_group (nb_group_id)');
        $this->addSql('ALTER TABLE nb_group_group ADD CONSTRAINT FK_E0D6D7488AAA5016 FOREIGN KEY (nb_group_id) REFERENCES nbGroups (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nb_group_group ADD CONSTRAINT FK_E0D6D748FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nb_group_subject ADD CONSTRAINT FK_1CE597948AAA5016 FOREIGN KEY (nb_group_id) REFERENCES nbGroups (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nb_group_subject ADD CONSTRAINT FK_1CE5979423EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subject_nb_group ADD CONSTRAINT FK_D22D79BE23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subject_nb_group ADD CONSTRAINT FK_D22D79BE8AAA5016 FOREIGN KEY (nb_group_id) REFERENCES nbGroups (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE nb_group_group DROP CONSTRAINT FK_E0D6D7488AAA5016');
        $this->addSql('ALTER TABLE nb_group_group DROP CONSTRAINT FK_E0D6D748FE54D947');
        $this->addSql('ALTER TABLE nb_group_subject DROP CONSTRAINT FK_1CE597948AAA5016');
        $this->addSql('ALTER TABLE nb_group_subject DROP CONSTRAINT FK_1CE5979423EDC87');
        $this->addSql('ALTER TABLE subject_nb_group DROP CONSTRAINT FK_D22D79BE23EDC87');
        $this->addSql('ALTER TABLE subject_nb_group DROP CONSTRAINT FK_D22D79BE8AAA5016');
        $this->addSql('DROP TABLE nb_group_group');
        $this->addSql('DROP TABLE nb_group_subject');
        $this->addSql('DROP TABLE subject_nb_group');
    }
}
