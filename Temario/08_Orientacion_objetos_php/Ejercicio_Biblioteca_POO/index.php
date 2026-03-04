<?php
require_once "Libro.php";
require_once "Biblioteca.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Digital</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <main class="container mt-4">
        <h1 class="text-center">Sistema de Gestión de Biblioteca Digital</h1>

        <div class="contenido">
            <?php
        try {
            // ===== Fase 1: Creación de Libros con constructor vacío =====
            echo '<div class="card">';
            echo '<h2>Fase 1: Creación de Libros</h2>';

            $libro1 = new Libro();
            $libro1->setTitulo("Cien años de soledad");
            $libro1->setAutor("Gabriel García Márquez");
            $libro1->setPaginas(432);

            $libro2 = new Libro();
            $libro2->setTitulo("El principito");
            $libro2->setAutor("Antoine de Saint-Exupéry");
            $libro2->setPaginas(96);

            $libro3 = new Libro();
            $libro3->setTitulo("1984");
            $libro3->setAutor("George Orwell");
            $libro3->setPaginas(328);

            echo "<p>Libro 1 creado: " . $libro1->getInfo() . "</p>";
            echo "<p>Libro 2 creado: " . $libro2->getInfo() . "</p>";
            echo "<p>Libro 3 creado: " . $libro3->getInfo() . "</p>";
            echo '</div>';

            // ===== Fase 2: Gestión de Biblioteca =====
            echo '<div class="card">';
            echo '<h2>Fase 2: Gestión de Biblioteca</h2>';

            $miBiblioteca = new Biblioteca();

            echo "<h3>Agregando libros a la biblioteca...</h3>";
            $miBiblioteca->agregarLibro($libro1);
            $miBiblioteca->agregarLibro($libro2);
            $miBiblioteca->agregarLibro($libro3);

            // Intento de duplicado
            $libro4 = new Libro();
            $libro4->setTitulo("1984");
            $libro4->setAutor("George Orwell");
            $libro4->setPaginas(328);

            echo "<p style='color:blue;'>Intentando agregar libro duplicado...</p>";
            $miBiblioteca->agregarLibro($libro4);

            echo '</div>';

            // ===== Fase 3: Consultas y Reportes =====
            echo '<div class="card">';
            echo '<h2>Fase 3: Consultas y Reportes</h2>';

            $libros = $miBiblioteca->getLibros();
            if (!empty($libros)) {
                echo '<table class="tabla-libros">';
                echo '<thead><tr><th>#</th><th>Título</th><th>Autor</th><th>Páginas</th></tr></thead><tbody>';
                foreach ($libros as $i => $l) {
                    echo "<tr>
                            <td>" . ($i + 1) . "</td>
                            <td>{$l->getTitulo()}</td>
                            <td>{$l->getAutor()}</td>
                            <td>{$l->getPaginas()}</td>
                          </tr>";
                }
                echo '</tbody></table>';
            }

            // Mostrar estadísticas
            $miBiblioteca->mostrarEstadisticas();
            echo '</div>';

        } catch (Exception $e) {
            echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
        }
        ?>
        </div>
    </main>

</body>

</html>