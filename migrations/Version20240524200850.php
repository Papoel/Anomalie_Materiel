<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240524200850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE constat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ot_id INTEGER NOT NULL, repere VARCHAR(12) NOT NULL, order_number VARCHAR(2) NOT NULL, description CLOB NOT NULL, is_qs BOOLEAN DEFAULT NULL, is_eip BOOLEAN DEFAULT NULL, solutions CLOB DEFAULT NULL, is_dsi_checked BOOLEAN DEFAULT NULL, analyse CLOB DEFAULT NULL, impacts CLOB DEFAULT NULL, solution_selected CLOB DEFAULT NULL, transfer_method BOOLEAN DEFAULT NULL, is_validate BOOLEAN DEFAULT NULL, is_dtor_tot BOOLEAN DEFAULT NULL, dt_tot VARCHAR(12) DEFAULT NULL, is_open_pa BOOLEAN DEFAULT NULL, pacsta VARCHAR(12) DEFAULT NULL, observation CLOB DEFAULT NULL, method_analyse CLOB DEFAULT NULL, method_impact CLOB DEFAULT NULL, method_solutions CLOB DEFAULT NULL, writer VARCHAR(100) NOT NULL, writer_edf VARCHAR(100) DEFAULT NULL, sn3 VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , transmission_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , return_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , cdt VARCHAR(100) DEFAULT NULL, realisation_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , is_solded BOOLEAN DEFAULT NULL, is_pending BOOLEAN DEFAULT NULL, CONSTRAINT FK_F96EDD98A01D3C68 FOREIGN KEY (ot_id) REFERENCES ot (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_F96EDD98A01D3C68 ON constat (ot_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE constat');
    }
}
