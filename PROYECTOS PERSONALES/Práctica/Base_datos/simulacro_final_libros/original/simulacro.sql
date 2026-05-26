CREATE DATABASE IF NOT EXISTS ejercicios_bbdd;
USE simulacro;

CREATE TABLE libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    genero VARCHAR(50) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    año_publicacion INT NOT NULL
);

INSERT INTO libros (titulo, autor, genero, precio, año_publicacion) VALUES
('Cien años de soledad', 'Gabriel García Márquez', 'Realismo mágico', 25.99, 1967),
('1984', 'George Orwell', 'Ciencia ficción', 19.50, 1949),
('Don Quijote de la Mancha', 'Miguel de Cervantes', 'Novela', 30.00, 1605),
('Fahrenheit 451', 'Ray Bradbury', 'Ciencia ficción', 18.75, 1953),
('La casa de los espíritus', 'Isabel Allende', 'Realismo mágico', 22.30, 1982);