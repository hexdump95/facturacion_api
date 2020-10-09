<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201009150934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articulo (id INT AUTO_INCREMENT NOT NULL, cantidad INT DEFAULT NULL, denominacion VARCHAR(255) DEFAULT NULL, precio INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articulo_categoria (articulo_id INT NOT NULL, categoria_id INT NOT NULL, INDEX IDX_B904BF0E2DBC2FC9 (articulo_id), INDEX IDX_B904BF0E3397707A (categoria_id), PRIMARY KEY(articulo_id, categoria_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, denominacion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, domicilio_id INT DEFAULT NULL, nombre VARCHAR(255) DEFAULT NULL, apellido VARCHAR(255) DEFAULT NULL, dni INT DEFAULT NULL, UNIQUE INDEX UNIQ_F41C9B257F8F253B (dni), UNIQUE INDEX UNIQ_F41C9B25166FC4DD (domicilio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detalle_factura (id INT AUTO_INCREMENT NOT NULL, articulo_id INT DEFAULT NULL, cantidad INT DEFAULT NULL, subtotal INT DEFAULT NULL, INDEX IDX_B1354EA12DBC2FC9 (articulo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domicilio (id INT AUTO_INCREMENT NOT NULL, nombre_calle VARCHAR(255) DEFAULT NULL, numero INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factura (id INT AUTO_INCREMENT NOT NULL, cliente_id INT DEFAULT NULL, fecha DATE DEFAULT NULL, numero INT DEFAULT NULL, total INT DEFAULT NULL, INDEX IDX_F9EBA009DE734E51 (cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factura_detalle_factura (factura_id INT NOT NULL, detalles_id INT NOT NULL, INDEX IDX_A4A61EBF04F795F (factura_id), UNIQUE INDEX UNIQ_A4A61EB8F32AB43 (detalles_id), PRIMARY KEY(factura_id, detalles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articulo_categoria ADD CONSTRAINT FK_B904BF0E2DBC2FC9 FOREIGN KEY (articulo_id) REFERENCES articulo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articulo_categoria ADD CONSTRAINT FK_B904BF0E3397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B25166FC4DD FOREIGN KEY (domicilio_id) REFERENCES domicilio (id)');
        $this->addSql('ALTER TABLE detalle_factura ADD CONSTRAINT FK_B1354EA12DBC2FC9 FOREIGN KEY (articulo_id) REFERENCES articulo (id)');
        $this->addSql('ALTER TABLE factura ADD CONSTRAINT FK_F9EBA009DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE factura_detalle_factura ADD CONSTRAINT FK_A4A61EBF04F795F FOREIGN KEY (factura_id) REFERENCES factura (id)');
        $this->addSql('ALTER TABLE factura_detalle_factura ADD CONSTRAINT FK_A4A61EB8F32AB43 FOREIGN KEY (detalles_id) REFERENCES detalle_factura (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articulo_categoria DROP FOREIGN KEY FK_B904BF0E2DBC2FC9');
        $this->addSql('ALTER TABLE detalle_factura DROP FOREIGN KEY FK_B1354EA12DBC2FC9');
        $this->addSql('ALTER TABLE articulo_categoria DROP FOREIGN KEY FK_B904BF0E3397707A');
        $this->addSql('ALTER TABLE factura DROP FOREIGN KEY FK_F9EBA009DE734E51');
        $this->addSql('ALTER TABLE factura_detalle_factura DROP FOREIGN KEY FK_A4A61EB8F32AB43');
        $this->addSql('ALTER TABLE cliente DROP FOREIGN KEY FK_F41C9B25166FC4DD');
        $this->addSql('ALTER TABLE factura_detalle_factura DROP FOREIGN KEY FK_A4A61EBF04F795F');
        $this->addSql('DROP TABLE articulo');
        $this->addSql('DROP TABLE articulo_categoria');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE detalle_factura');
        $this->addSql('DROP TABLE domicilio');
        $this->addSql('DROP TABLE factura');
        $this->addSql('DROP TABLE factura_detalle_factura');
    }
}
