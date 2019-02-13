<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190213081338 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_6BAF7870F8BD700D');
        $this->addSql('DROP INDEX IDX_6BAF787059D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient AS SELECT id, recipe_id, unit_id, label, quantity FROM ingredient');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('CREATE TABLE ingredient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER NOT NULL, unit_id INTEGER DEFAULT NULL, label VARCHAR(255) NOT NULL COLLATE BINARY, quantity INTEGER NOT NULL, CONSTRAINT FK_6BAF787059D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6BAF7870F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ingredient (id, recipe_id, unit_id, label, quantity) SELECT id, recipe_id, unit_id, label, quantity FROM __temp__ingredient');
        $this->addSql('DROP TABLE __temp__ingredient');
        $this->addSql('CREATE INDEX IDX_6BAF7870F8BD700D ON ingredient (unit_id)');
        $this->addSql('CREATE INDEX IDX_6BAF787059D8A214 ON ingredient (recipe_id)');
        $this->addSql('DROP INDEX IDX_AB02B02759D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__opinion AS SELECT id, recipe_id, commentary, note FROM opinion');
        $this->addSql('DROP TABLE opinion');
        $this->addSql('CREATE TABLE opinion (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER NOT NULL, commentary VARCHAR(255) NOT NULL COLLATE BINARY, note SMALLINT NOT NULL, CONSTRAINT FK_AB02B02759D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO opinion (id, recipe_id, commentary, note) SELECT id, recipe_id, commentary, note FROM __temp__opinion');
        $this->addSql('DROP TABLE __temp__opinion');
        $this->addSql('CREATE INDEX IDX_AB02B02759D8A214 ON opinion (recipe_id)');
        $this->addSql('ALTER TABLE unit ADD COLUMN name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_6BAF787059D8A214');
        $this->addSql('DROP INDEX IDX_6BAF7870F8BD700D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient AS SELECT id, recipe_id, unit_id, label, quantity FROM ingredient');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('CREATE TABLE ingredient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER NOT NULL, unit_id INTEGER DEFAULT NULL, label VARCHAR(255) NOT NULL, quantity INTEGER NOT NULL)');
        $this->addSql('INSERT INTO ingredient (id, recipe_id, unit_id, label, quantity) SELECT id, recipe_id, unit_id, label, quantity FROM __temp__ingredient');
        $this->addSql('DROP TABLE __temp__ingredient');
        $this->addSql('CREATE INDEX IDX_6BAF787059D8A214 ON ingredient (recipe_id)');
        $this->addSql('CREATE INDEX IDX_6BAF7870F8BD700D ON ingredient (unit_id)');
        $this->addSql('DROP INDEX IDX_AB02B02759D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__opinion AS SELECT id, recipe_id, commentary, note FROM opinion');
        $this->addSql('DROP TABLE opinion');
        $this->addSql('CREATE TABLE opinion (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER NOT NULL, commentary VARCHAR(255) NOT NULL, note SMALLINT NOT NULL)');
        $this->addSql('INSERT INTO opinion (id, recipe_id, commentary, note) SELECT id, recipe_id, commentary, note FROM __temp__opinion');
        $this->addSql('DROP TABLE __temp__opinion');
        $this->addSql('CREATE INDEX IDX_AB02B02759D8A214 ON opinion (recipe_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__unit AS SELECT id FROM unit');
        $this->addSql('DROP TABLE unit');
        $this->addSql('CREATE TABLE unit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('INSERT INTO unit (id) SELECT id FROM __temp__unit');
        $this->addSql('DROP TABLE __temp__unit');
    }
}
