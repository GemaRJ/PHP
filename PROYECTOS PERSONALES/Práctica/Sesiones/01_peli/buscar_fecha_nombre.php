<?php
session_start();

if (!isset($_SESSION["entradas"])) {
    $_SESSION["entradas"] = [];
}

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombreBuscar = htmlspecialchars(trim($_POST["nombre"]));
    $diaBuscar = htmlspecialchars(trim($_POST["dia"]));

    foreach ($_SESSION["entradas"] as $entrada) {

        # buscar por nombre
        if (
            $nombreBuscar != "" &&
            strtolower($entrada["nombre"]) == strtolower($nombreBuscar)
        ) {

            $resultado[] = $entrada;
        }

        # buscar por fecha
        elseif (
            $diaBuscar != "" &&
            $entrada["dia"] == $diaBuscar
        ) {

            $resultado[] = $entrada;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar entrada</title>



</head>

<body>

    <h1>BUSCAR ENTRADA POR NOMBRE O FECHA</h1>

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

        echo "<h3>Entradas encontradas:</h3>";

        echo "<ul>";

        foreach ($resultado as $entrada) {

            echo "<li>";

            echo "Nombre: " . htmlspecialchars($entrada["nombre"]) . " | ";

            echo "Día: " . htmlspecialchars($entrada["dia"]) . " | ";

            echo "Hora: " . htmlspecialchars($entrada["hora"]);

            echo "</li>";
        }

        echo "</ul>";
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {

        echo "<p>No se encontraron entradas.</p>";
    }
    ?>

    <br>

    <a href="index.php">Volver al menú</a>

</body>

</html>