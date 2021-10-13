CREATE DATABASE IF NOT EXISTS bienes_raices;

CREATE TABLE bienes_raices.vendedores 
(
    id INT(6) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(45) DEFAULT NULL,
    apellido VARCHAR(45) DEFAULT NULL,
    telefono VARCHAR(15) DEFAULT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE bienes_raices.propiedades 
(
    id INT(6) NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(60) DEFAULT NULL,
    precio INT(10) DEFAULT NULL,
    imagen VARCHAR(200) DEFAULT NULL,
    descripcion LONGTEXT,
    habitaciones INT(2) DEFAULT NULL,
    wc INT(2) DEFAULT NULL,
    estacionamiento INT(2) DEFAULT NULL,
    creado DATE DEFAULT NULL,
    vendedorId INT(6) DEFAULT NULL,
    PRIMARY KEY (id),
    KEY vendedorId (vendedorId),
    CONSTRAINT vendedorId FOREIGN KEY (vendedorId) REFERENCES vendedores (id)
);

CREATE TABLE bienes_raices.usuarios 
(
    id INT(2) NOT NULL AUTO_INCREMENT,
    user VARCHAR(64) NOT NULL,
    password VARCHAR(60) DEFAULT NULL,
    PRIMARY KEY (id)
);