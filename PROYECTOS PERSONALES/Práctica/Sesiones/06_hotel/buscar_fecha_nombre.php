<?php
session_start();

if (!isset($_SESSION["habitaciones"])) {
    $_SESSION["habitaciones"] = [];
}

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombreBuscar = htmlspecialchars(trim($_POST["nombre"]));
    $diaBuscar = htmlspecialchars(trim($_POST["dia"]));

    foreach ($_SESSION["habitaciones"] as $habitacion) {

        # buscar por nombre
        if (
            $nombreBuscar != "" &&
            strtolower($habitacion["nombre"]) == strtolower($nombreBuscar)
        ) {

            $resultado[] = $habitacion;
        }

        # buscar por fecha
        elseif (
            $diaBuscar != "" &&
            $habitacion["dia"] == $diaBuscar
        ) {

            $resultado[] = $habitacion;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar reserva</title>



</head>

<body>

    <h1>BUSCAR RESERVA</h1>

    <form action="buscar_fecha_nombre.php" method="POST">

        Nombre:
        <br>
        <input type="text" name="nombre">

        <br><br>

        Día:
        <br>
        <input type="date" name="dia">

        <br><br>

        <input type="submit" value="Buscar">

    </form>

    <br>


    <?php

    if (count($resultado) > 0) {

        echo "<h3>Reservas encontradas:</h3>";

        echo "<ul>";

        foreach ($resultado as $habitacion) {

            echo "<li>";

            echo "Nombre: " . htmlspecialchars($habitacion["nombre"]) . " | ";

            echo "Día: " . htmlspecialchars($habitacion["dia"]) . " | ";

            echo "Habitación: " . htmlspecialchars($habitacion["habitacion"]);

            echo "</li>";
        }

        echo "</ul>";
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {

        echo "<p>No se encontraron reservas.</p>";
    }
    ?>

    <br>

    <a href="index.php">Volver al menú</a>

</body>

</html>