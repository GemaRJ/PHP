CREATE DATABASE eventos_tech;
USE eventos_tech;
CREATE TABLE eventos (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nombre VARCHAR(100) NOT NULL,
 fecha DATE NOT NULL,
 descripcion TEXT,
 lugar VARCHAR(100),
 capacidad INT
);
