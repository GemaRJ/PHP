<?php
session_start();


if (!isset($_SESSION["entradas"])) {
    $_SESSION["entradas"] = [];
}

$resultado = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $nombreBuscar = htmlspecialchars(trim($_POST["nombre"]));


    foreach ($_SESSION["entradas"] as $entrada) {


        if (strtolower($entrada["nombre"]) == strtolower($nombreBuscar)) {

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
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>BUSCAR ENTRADA</h1>

    <form method="POST">

        Nombre:
        <input type="text" name="nombre" required>

        <input type="submit" value="Buscar">

    </form>

    <hr>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


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
        } else {

            echo "<p>No se encontraron entradas.</p>";
        }
    }
    ?>

    <br>

    <a href="index.php">Volver al menú</a>

</body>

</html>