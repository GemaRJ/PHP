<?php
session_start();

if (!isset($_SESSION["entradas"])) {
    $_SESSION["entradas"] = [];
}

$mensaje = "";
$resultado = [];

# ===== RESERVAR ENTRADA =====
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["reservar"])) {

    if (count($_SESSION["entradas"]) >= 100) {

        $mensaje = "No se pueden registrar más entradas. Máximo 100.";
    } else {

        $nombre = htmlspecialchars(trim($_POST["nombre"]));
        $dia = htmlspecialchars(trim($_POST["dia"]));
        $hora = htmlspecialchars(trim($_POST["hora"]));

        if ($nombre == "" || $dia == "" || $hora == "") {

            $mensaje = "Todos los campos son obligatorios.";
        } else {

            $_SESSION["entradas"][] = [
                "nombre" => $nombre,
                "dia" => $dia,
                "hora" => $hora
            ];

            $mensaje = "Entrada registrada correctamente.";
        }
    }
}

# ===== BUSCAR POR NOMBRE =====
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["buscarNombre"])) {

    $nombreBuscar = htmlspecialchars(trim($_POST["nombre"]));

    foreach ($_SESSION["entradas"] as $entrada) {

        if (strtolower($entrada["nombre"]) == strtolower($nombreBuscar)) {
            $resultado[] = $entrada;
        }
    }
}

# ===== BUSCAR POR FECHA =====
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["buscarFecha"])) {

    $diaBuscar = htmlspecialchars(trim($_POST["dia"]));

    foreach ($_SESSION["entradas"] as $entrada) {

        if ($entrada["dia"] == $diaBuscar) {
            $resultado[] = $entrada;
        }
    }
}

# ===== BORRAR SESIÓN =====
if (isset($_GET["borrar"])) {

    session_destroy();
    session_start();

    $_SESSION["entradas"] = [];

    $mensaje = "Sesión borrada correctamente.";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cine con sesiones</title>

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

    <h1>GESTIÓN DE ENTRADAS DE CINE</h1>

    <h2>MENÚ INICIAL</h2>

    <ul>
        <li><a href="index.php?reservar=1">Reservar entrada Cine</a></li>
        <li><a href="index.php?buscarNombre=1">Buscar por nombre</a></li>
        <li><a href="index.php?buscarFecha=1">Buscar por fecha</a></li>
        <li><a href="index.php?ver=1">Ver todas las Entradas</a></li>
        <li><a href="index.php?borrar=1">Borrar Sesión</a></li>
    </ul>

    <hr>

    <?php
    if ($mensaje != "") {
        echo "<p>" . htmlspecialchars($mensaje) . "</p>";
    }
    ?>

    <?php if (isset($_GET["reservar"])) { ?>

        <h2>RESERVAR ENTRADA</h2>

        <form action="index.php?reservar=1" method="POST">

            Nombre:<br>
            <input type="text" name="nombre" required>

            <br><br>

            Día:<br>
            <input type="date" name="dia" required>

            <br><br>

            Hora:<br>
            <input type="time" name="hora" required>

            <br><br>

            <input type="submit" value="Reservar entrada">

        </form>

    <?php } ?>

    <?php if (isset($_GET["buscarNombre"])) { ?>

        <h2>BUSCAR POR NOMBRE</h2>

        <form action="index.php?buscarNombre=1" method="POST">

            Nombre:<br>
            <input type="text" name="nombre" required>

            <br><br>

            <input type="submit" value="Buscar">

        </form>

        <?php
        if (count($resultado) > 0) {

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

    <?php } ?>

    <?php if (isset($_GET["buscarFecha"])) { ?>

        <h2>BUSCAR POR FECHA</h2>

        <form action="index.php?buscarFecha=1" method="POST">

            Día:<br>
            <input type="date" name="dia" required>

            <br><br>

            <input type="submit" value="Buscar">

        </form>

        <?php
        if (count($resultado) > 0) {

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

    <?php } ?>

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