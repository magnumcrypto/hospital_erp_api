<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240524102507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointments (id INT AUTO_INCREMENT NOT NULL, id_patient INT NOT NULL, id_doctor INT NOT NULL, appointment_date DATETIME NOT NULL, state VARCHAR(255) NOT NULL, notes LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6A41727AC4477E9B (id_patient), INDEX IDX_6A41727A39F74687 (id_doctor), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bills (id INT AUTO_INCREMENT NOT NULL, id_patient INT NOT NULL, amount NUMERIC(10, 2) NOT NULL, state TINYINT(1) DEFAULT 0 NOT NULL, due_date DATETIME NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_22775DD0C4477E9B (id_patient), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doctors (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, surnames VARCHAR(100) NOT NULL, specialization VARCHAR(100) NOT NULL, phone_number VARCHAR(15) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_B67687BEDB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_histories (id INT AUTO_INCREMENT NOT NULL, id_patient INT NOT NULL, id_doctor INT NOT NULL, visit_date DATETIME NOT NULL, diagnosis LONGTEXT NOT NULL, treatment LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3A829019C4477E9B (id_patient), INDEX IDX_3A82901939F74687 (id_doctor), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notifications (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, message LONGTEXT NOT NULL, is_read TINYINT(1) DEFAULT 0 NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6000B0D36B3CA4B (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patients (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, surnames VARCHAR(100) NOT NULL, birth_date DATETIME NOT NULL, gender VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone_number VARCHAR(15) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_2CCC2E2CDB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payments (id INT AUTO_INCREMENT NOT NULL, id_bill INT NOT NULL, amount NUMERIC(10, 2) NOT NULL, payment_day DATETIME NOT NULL, payment_method VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_65D29B32F10105E1 (id_bill), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, user_name VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointments ADD CONSTRAINT FK_6A41727AC4477E9B FOREIGN KEY (id_patient) REFERENCES patients (id)');
        $this->addSql('ALTER TABLE appointments ADD CONSTRAINT FK_6A41727A39F74687 FOREIGN KEY (id_doctor) REFERENCES doctors (id)');
        $this->addSql('ALTER TABLE bills ADD CONSTRAINT FK_22775DD0C4477E9B FOREIGN KEY (id_patient) REFERENCES patients (id)');
        $this->addSql('ALTER TABLE doctors ADD CONSTRAINT FK_B67687BEDB38439E FOREIGN KEY (usuario_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE medical_histories ADD CONSTRAINT FK_3A829019C4477E9B FOREIGN KEY (id_patient) REFERENCES patients (id)');
        $this->addSql('ALTER TABLE medical_histories ADD CONSTRAINT FK_3A82901939F74687 FOREIGN KEY (id_doctor) REFERENCES doctors (id)');
        $this->addSql('ALTER TABLE notifications ADD CONSTRAINT FK_6000B0D36B3CA4B FOREIGN KEY (id_user) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2CDB38439E FOREIGN KEY (usuario_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE payments ADD CONSTRAINT FK_65D29B32F10105E1 FOREIGN KEY (id_bill) REFERENCES bills (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointments DROP FOREIGN KEY FK_6A41727AC4477E9B');
        $this->addSql('ALTER TABLE appointments DROP FOREIGN KEY FK_6A41727A39F74687');
        $this->addSql('ALTER TABLE bills DROP FOREIGN KEY FK_22775DD0C4477E9B');
        $this->addSql('ALTER TABLE doctors DROP FOREIGN KEY FK_B67687BEDB38439E');
        $this->addSql('ALTER TABLE medical_histories DROP FOREIGN KEY FK_3A829019C4477E9B');
        $this->addSql('ALTER TABLE medical_histories DROP FOREIGN KEY FK_3A82901939F74687');
        $this->addSql('ALTER TABLE notifications DROP FOREIGN KEY FK_6000B0D36B3CA4B');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2CDB38439E');
        $this->addSql('ALTER TABLE payments DROP FOREIGN KEY FK_65D29B32F10105E1');
        $this->addSql('DROP TABLE appointments');
        $this->addSql('DROP TABLE bills');
        $this->addSql('DROP TABLE doctors');
        $this->addSql('DROP TABLE medical_histories');
        $this->addSql('DROP TABLE notifications');
        $this->addSql('DROP TABLE patients');
        $this->addSql('DROP TABLE payments');
        $this->addSql('DROP TABLE `user`');
    }
}
