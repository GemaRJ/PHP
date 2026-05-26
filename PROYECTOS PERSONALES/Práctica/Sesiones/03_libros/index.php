<?php
session_start();

# si no existe el array de entradas, lo creamos
if (!isset($_SESSION["libros"])) {
    $_SESSION["libros"] = [];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de libros</title>
</head>

<body>

    <h1>GESTIÓN DE LIBROS</h1>

    <h2>MENÚ INICIAL</h2>

    <ul>
        <li><a href="registrar.php">Añadir libro</a></li>
        <li><a href="index.php?ver=1">Ver todos los libros</a></li>
        <li><a href="borrar.php">Borrar sesión</a></li>
    </ul>

    <hr>
    <?php
    if (isset($_GET["ver"])) {

        echo "<h2>TODOS LOS LIBROS</h2>";

        if (count($_SESSION["libros"]) > 0) {
            echo "<ul>";

            foreach ($_SESSION["libros"] as $i => $libros) {
                echo "<li>";
                echo "Libro " . ($i + 1) . " | ";
                echo "Título: " . htmlspecialchars($libros["titulo"]) . " | ";
                echo "Autor: " . htmlspecialchars($libros["autor"]) . " | ";
                echo "Anio: " . htmlspecialchars($libros["anio"]);
                echo "</li>";
            }

            echo "</ul>";
        } else {
            echo "<p>No hay LIBROS registradOs.</p>";
        }
    }
    ?>
</body>

</html>