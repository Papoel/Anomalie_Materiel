<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240624170113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE constats (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', reference VARCHAR(50) DEFAULT NULL, functional_marker VARCHAR(12) NOT NULL, equipment_label VARCHAR(75) NOT NULL, description LONGTEXT NOT NULL, proposed_solutions LONGTEXT NOT NULL, detection_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', writer VARCHAR(50) NOT NULL, edf_control_name VARCHAR(50) DEFAULT NULL, edf_control_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', analysis LONGTEXT NOT NULL, potential_impacts LONGTEXT NOT NULL, retained_solutions LONGTEXT DEFAULT NULL, sn3_name VARCHAR(50) NOT NULL, sn3_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', transmission_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_transmitted_method TINYINT(1) DEFAULT NULL, validation VARCHAR(255) DEFAULT NULL, dt_tot_number VARCHAR(12) DEFAULT NULL, pa_csta_number VARCHAR(12) DEFAULT NULL, validation_responsable VARCHAR(50) DEFAULT NULL, validation_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', observations LONGTEXT DEFAULT NULL, implementation_responsable VARCHAR(50) DEFAULT NULL, implementation_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', method_analysis_confirmation LONGTEXT DEFAULT NULL, method_impact_protection_interests LONGTEXT DEFAULT NULL, method_retained_solutions LONGTEXT DEFAULT NULL, created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `users` (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, nni VARCHAR(6) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', password VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), UNIQUE INDEX UNIQ_IDENTIFIER_NNI (nni), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_orders (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', order_number VARCHAR(8) NOT NULL, libelle VARCHAR(100) NOT NULL, project VARCHAR(6) NOT NULL, state VARCHAR(255) DEFAULT NULL, created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_tasks (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', work_order_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', task_number SMALLINT NOT NULL, libelle VARCHAR(100) NOT NULL, instruction LONGTEXT DEFAULT NULL, created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_78A31EB8582AE764 (work_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE work_tasks ADD CONSTRAINT FK_78A31EB8582AE764 FOREIGN KEY (work_order_id) REFERENCES work_orders (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE work_tasks DROP FOREIGN KEY FK_78A31EB8582AE764');
        $this->addSql('DROP TABLE constats');
        $this->addSql('DROP TABLE `users`');
        $this->addSql('DROP TABLE work_orders');
        $this->addSql('DROP TABLE work_tasks');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
