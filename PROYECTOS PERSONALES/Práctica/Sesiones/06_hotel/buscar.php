<?php
session_start();

# si no existe el array de entradas, lo creamos
if (!isset($_SESSION["habitaciones"])) {
    $_SESSION["habitaciones"] = [];
}

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    # recogemos y limpiamos el nombre
    $nombreBuscar = htmlspecialchars(trim($_POST["nombre"]));

    # recorremos todas las entradas
    foreach ($_SESSION["habitaciones"] as $habitacion) {

        # buscamos sin distinguir mayúsculas/minúsculas
        if (strtolower($habitacion["nombre"]) == strtolower($nombreBuscar)) {

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

    <form action="buscar.php" method="POST">

        Nombre:
        <br>
        <input type="text" name="nombre" required>

        <br><br>

        <input type="submit" value="Buscar">

    </form>

    <br>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        # si encuentra entradas
        if (count($resultado) > 0) {

            echo "<h3>Habitaciones encontradas:</h3>";

            echo "<ul>";

            foreach ($resultado as $habitacion) {

                echo "<li>";

                echo "Nombre: " . htmlspecialchars($habitacion["nombre"]) . " | ";

                echo "Día: " . htmlspecialchars($habitacion["dia"]) . " | ";

                echo "Habitación: " . htmlspecialchars($habitacion["habitacion"]);

                echo "</li>";
            }

            echo "</ul>";
        } else {

            echo "<p>No se encontraron habitaciones.</p>";
        }
    }
    ?>

    <br>
    <a href="index.php">Volver al menú</a>

</body>

</html>