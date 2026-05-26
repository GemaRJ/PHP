<?php
session_start();

# si no existe el array de entradas, lo creamos
if (!isset($_SESSION["alumnos"])) {
    $_SESSION["alumnos"] = [];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de alumnos</title>
</head>

<body>

    <h1>GESTIÓN DE ALUMNOS</h1>

    <h2>MENÚ INICIAL</h2>

    <ul>
        <li><a href="registrar.php">Registrar alumno</a></li>
        <li><a href="index.php?ver=1">Ver todos los alumnos</a></li>
        <li><a href="borrar.php">Borrar sesión</a></li>
    </ul>

    <hr>

    <?php
    if (isset($_GET["ver"])) {

        echo "<h2>TODOS LOS ALUMNOS</h2>";

        if (count($_SESSION["alumnos"]) > 0) {
            echo "<ul>";

            foreach ($_SESSION["alumnos"] as $i => $alumno) {
                echo "<li>";
                echo "Alumno " . ($i + 1) . " | ";
                echo "Nombre: " . htmlspecialchars($alumno["nombre"]) . " | ";
                echo "Curso: " . htmlspecialchars($alumno["curso"]) . " | ";
                echo "Nota: " . htmlspecialchars($alumno["nota"]);
                echo "</li>";
            }

            echo "</ul>";
        } else {
            echo "<p>No hay alumnos en la sesión.</p>";
        }
    }
    ?>
</body>

</html>