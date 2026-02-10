CREATE DATABASE IF NOT EXISTS gestion_productos;
USE gestion_productos;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    cantidad INT NOT NULL DEFAULT 0,
    categoria VARCHAR(50),
    fecha_creacion DATE NOT NULL,
    activo TINYINT(1) DEFAULT 1
);

-- Insertar algunos datos de ejemplo
INSERT INTO productos (nombre, precio, cantidad, categoria, fecha_creacion, activo) VALUES
('Laptop Gamer', 1299.99, 15, 'Electrónica', '2024-01-15', 1),
('Smartphone', 699.50, 30, 'Electrónica', '2024-02-10', 1),
('Silla Oficina', 199.99, 25, 'Muebles', '2024-01-20', 1),
('Libro PHP', 29.99, 100, 'Libros', '2024-02-01', 1),
('Auriculares', 89.99, 50, 'Accesorios', '2024-01-25', 0);