<?php
session_start();

# si no existe el array de entradas, lo creamos
if (!isset($_SESSION["habitaciones"])) {
    $_SESSION["habitaciones"] = [];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Hotel con sesiones</title>
</head>

<body>

    <h1>GESTIÓN DE RESERVAS DE HOTEL</h1>

    <h2>MENÚ INICIAL</h2>

    <ul>
        <li><a href="reservar.php">Reservar habitación</a></li>
        <li><a href="buscar.php">Buscar reserva</a></li>
        <li><a href="buscar_fecha_nombre.php">Buscar reserva por nombre o fecha</a></li>
        <li><a href="index.php?ver=1">Ver todas las reservas</a></li>
        <li><a href="borrar.php">Borrar sesión</a></li>
    </ul>
    <hr>
    <?php
    if (isset($_GET["ver"])) {

        echo "<h2>TODAS LAS HABITACIONES</h2>";

        if (count($_SESSION["habitaciones"]) > 0) {
            echo "<ul>";

            foreach ($_SESSION["habitaciones"] as $i => $habitaciones) {
                echo "<li>";
                echo "Entrada " . ($i + 1) . " | ";
                echo "Nombre: " . htmlspecialchars($habitaciones["nombre"]) . " | ";
                echo "Día: " . htmlspecialchars($habitaciones["dia"]) . " | ";
                echo "habitacion: " . htmlspecialchars($habitaciones["habitacion"]);
                echo "</li>";
            }

            echo "</ul>";
        } else {
            echo "<p>No hay habitaciones registradas en la sesión.</p>";
        }
    }
    ?>

</body>

</html>