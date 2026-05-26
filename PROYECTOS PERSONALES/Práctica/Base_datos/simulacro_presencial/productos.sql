CREATE DATABASE productos;

USE productos;

CREATE TABLE productos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    cantidad INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL
);

INSERT INTO productos (nombre, cantidad, precio) VALUES
('Camisa blanca', 10, 15.99),
('Pantalón jeans', 20, 29.99),
('Zapatillas deportivas', 15, 49.99),
('Chaquetón de cuero', 5, 99.99),
('Gorra de béisbol', 8, 9.99);
