CREATE DATABASE examen2;

USE examen2;

CREATE TABLE ordenador (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    fecha DATE,
    nombre VARCHAR(200),
    vendido BOOL,
    precio INT,
    PRIMARY KEY(id)
);