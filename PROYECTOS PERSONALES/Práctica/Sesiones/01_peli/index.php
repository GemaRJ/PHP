<?php
session_start();

# si no existe el array de entradas, lo creamos
if (!isset($_SESSION["entradas"])) {
    $_SESSION["entradas"] = [];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cine con sesiones</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>GESTIÓN DE ENTRADAS DE CINE</h1>

    <h2>MENÚ INICIAL</h2>
    <ul>
        <li><a href="reservar.php">Reservar entrada Cine</a></li>
        <li><a href="buscar.php">Buscar entrada</a></li>
        <li><a href="buscar_fecha_nombre.php">Buscar reserva por nombre o fecha</a></li>
        <li><a href="index.php?ver=1">Ver todas las Entradas</a></li>
        <li><a href="borrar.php">Borrar Sesión</a></li>
    </ul>

    <hr>

    <?php
    if (isset($_GET["ver"])) {

        echo "<h2>TODAS LAS ENTRADAS</h2>";

        if (count($_SESSION["entradas"]) > 0) {
            echo "<ul>";

            foreach ($_SESSION["entradas"] as $i => $entrada) {
                echo "<li>";
                echo "Entrada " . ($i + 1) . " | ";
                echo "Nombre: " . htmlspecialchars($entrada["nombre"]) . " | ";
                echo "Día: " . htmlspecialchars($entrada["dia"]) . " | ";
                echo "Hora: " . htmlspecialchars($entrada["hora"]);
                echo "</li>";
            }

            echo "</ul>";
        } else {
            echo "<p>No hay entradas registradas en la sesión.</p>";
        }
    }
    ?>

</body>

</html>