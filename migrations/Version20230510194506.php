<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510194506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actividades (id INT AUTO_INCREMENT NOT NULL, Cssclass_id INT NOT NULL, actividad VARCHAR(255) NOT NULL, INDEX IDX_73D548DEF9C35427 (Cssclass_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Cssclass (id INT AUTO_INCREMENT NOT NULL, Cssclass VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dias (id INT AUTO_INCREMENT NOT NULL, dia VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hora_horario (id INT AUTO_INCREMENT NOT NULL, hora TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horario (id INT AUTO_INCREMENT NOT NULL, actividad_id INT NOT NULL, sala_id INT NOT NULL, hora_id INT NOT NULL, dia_id INT NOT NULL, capacidad INT NOT NULL, INDEX IDX_E25853A36014FACA (actividad_id), INDEX IDX_E25853A3C51CDF3F (sala_id), INDEX IDX_E25853A3451F5F98 (hora_id), INDEX IDX_E25853A3AC1F7597 (dia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, item VARCHAR(255) NOT NULL, titulo VARCHAR(255) NOT NULL, enlace VARCHAR(255) NOT NULL, orden INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE noticias (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, descrip LONGTEXT NOT NULL, descrip_extend LONGTEXT NOT NULL, organizador VARCHAR(255) NOT NULL, imagen LONGBLOB NOT NULL, fecha_publicacion DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sala (id INT AUTO_INCREMENT NOT NULL, nombre_sala VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actividades ADD CONSTRAINT FK_73D548DEF9C35427 FOREIGN KEY (Cssclass_id) REFERENCES Cssclass (id)');
        $this->addSql('ALTER TABLE horario ADD CONSTRAINT FK_E25853A36014FACA FOREIGN KEY (actividad_id) REFERENCES actividades (id)');
        $this->addSql('ALTER TABLE horario ADD CONSTRAINT FK_E25853A3C51CDF3F FOREIGN KEY (sala_id) REFERENCES sala (id)');
        $this->addSql('ALTER TABLE horario ADD CONSTRAINT FK_E25853A3451F5F98 FOREIGN KEY (hora_id) REFERENCES hora_horario (id)');
        $this->addSql('ALTER TABLE horario ADD CONSTRAINT FK_E25853A3AC1F7597 FOREIGN KEY (dia_id) REFERENCES dias (id)');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actividades DROP FOREIGN KEY FK_73D548DEF9C35427');
        $this->addSql('ALTER TABLE horario DROP FOREIGN KEY FK_E25853A36014FACA');
        $this->addSql('ALTER TABLE horario DROP FOREIGN KEY FK_E25853A3C51CDF3F');
        $this->addSql('ALTER TABLE horario DROP FOREIGN KEY FK_E25853A3451F5F98');
        $this->addSql('ALTER TABLE horario DROP FOREIGN KEY FK_E25853A3AC1F7597');
        $this->addSql('DROP TABLE actividades');
        $this->addSql('DROP TABLE Cssclass');
        $this->addSql('DROP TABLE dias');
        $this->addSql('DROP TABLE hora_horario');
        $this->addSql('DROP TABLE horario');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE noticias');
        $this->addSql('DROP TABLE sala');
        $this->addSql('ALTER TABLE `user` DROP is_verified');
    }
}
