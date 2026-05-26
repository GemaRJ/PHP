<?php
session_start();

if (!isset($_SESSION["coches"])) {
    $_SESSION["coches"] = [];
}

$mensaje = "";

# RESERVAR COCHE
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (count($_SESSION["coches"]) >= 100) {

        $mensaje = "No se pueden registrar más coches. Máximo 100.";
    } else {

        $nombre = htmlspecialchars(trim($_POST["nombre"]));
        $modelo = htmlspecialchars(trim($_POST["modelo"]));
        $dia = htmlspecialchars(trim($_POST["dia"]));

        if ($nombre == "" || $modelo == "" || $dia == "") {

            $mensaje = "Todos los campos son obligatorios.";
        } else {

            $_SESSION["coches"][] = [
                "nombre" => $nombre,
                "modelo" => $modelo,
                "dia" => $dia
            ];

            $mensaje = "Coche registrado correctamente.";
        }
    }
}

# BORRAR SESIÓN
if (isset($_GET["borrar"])) {

    session_destroy();

    session_start();

    $_SESSION["coches"] = [];

    $mensaje = "Sesión borrada correctamente.";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reserva de coches</title>

    <style>
        body {
            font-family: Arial;
            margin: 30px;
            background-color: #f4f4f4;
        }

        li {
            list-style: none;
            margin-bottom: 10px;
            background-color: white;
            padding: 10px;
            border: 1px solid gray;
        }

        input {
            margin-bottom: 15px;
            padding: 5px;
            width: 200px;
        }

        input[type="submit"] {
            width: auto;
        }
    </style>
</head>

<body>

    <h1>GESTIÓN DE RESERVAS DE COCHES</h1>

    <h2>MENÚ INICIAL</h2>

    <ul>
        <li><a href="index.php?reservar=1">Reservar coche</a></li>
        <li><a href="index.php?ver=1">Ver todas las reservas</a></li>
        <li><a href="index.php?borrar=1">Borrar sesión</a></li>
    </ul>

    <hr>

    <?php
    if ($mensaje != "") {
        echo "<p>" . htmlspecialchars($mensaje) . "</p>";
    }
    ?>

    <?php if (isset($_GET["reservar"])) { ?>

        <h2>RESERVAR COCHE</h2>

        <form action="index.php?reservar=1" method="POST">

            Nombre:
            <br>
            <input type="text" name="nombre" required>

            <br><br>

            Modelo del coche:
            <br>
            <input type="text" name="modelo" required>

            <br><br>

            Día de reserva:
            <br>
            <input type="date" name="dia" required>

            <br><br>

            <input type="submit" value="Reservar coche">

        </form>

    <?php } ?>

    <?php
    if (isset($_GET["ver"])) {

        echo "<h2>TODAS LAS RESERVAS</h2>";

        if (count($_SESSION["coches"]) > 0) {

            echo "<ul>";

            foreach ($_SESSION["coches"] as $i => $coche) {

                echo "<li>";
                echo "Reserva " . ($i + 1) . " | ";
                echo "Nombre: " . htmlspecialchars($coche["nombre"]) . " | ";
                echo "Modelo: " . htmlspecialchars($coche["modelo"]) . " | ";
                echo "Día: " . htmlspecialchars($coche["dia"]);
                echo "</li>";
            }

            echo "</ul>";
        } else {

            echo "<p>No hay coches registrados.</p>";
        }
    }
    ?>

</body>

</html>