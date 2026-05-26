<?php
session_start();

if (!isset($_SESSION["libros"])) {
    $_SESSION["libros"] = [];
}

$mensaje = "";

# RESERVAR LIBRO
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (count($_SESSION["libros"]) >= 100) {

        $mensaje = "No se pueden registrar más libros. Máximo 100.";
    } else {

        $nombre = htmlspecialchars(trim($_POST["nombre"]));
        $titulo = htmlspecialchars(trim($_POST["titulo"]));
        $fecha = htmlspecialchars(trim($_POST["fecha"]));

        if ($nombre == "" || $titulo == "" || $fecha == "") {

            $mensaje = "Todos los campos son obligatorios.";
        } else {

            $_SESSION["libros"][] = [
                "nombre" => $nombre,
                "titulo" => $titulo,
                "fecha" => $fecha
            ];

            $mensaje = "Libro reservado correctamente.";
        }
    }
}

# BORRAR SESIÓN
if (isset($_GET["borrar"])) {

    session_destroy();

    session_start();

    $_SESSION["libros"] = [];

    $mensaje = "Sesión borrada correctamente.";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reserva de libros</title>

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

    <h1>GESTIÓN DE RESERVAS DE LIBROS</h1>

    <h2>MENÚ INICIAL</h2>

    <ul>
        <li><a href="index.php?reservar=1">Reservar libro</a></li>
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

        <h2>RESERVAR LIBRO</h2>

        <form action="index.php?reservar=1" method="POST">

            Nombre:
            <br>
            <input type="text" name="nombre" required>

            <br><br>

            Título del libro:
            <br>
            <input type="text" name="titulo" required>

            <br><br>

            Fecha de reserva:
            <br>
            <input type="date" name="fecha" required>

            <br><br>

            <input type="submit" value="Reservar libro">

        </form>

    <?php } ?>

    <?php
    if (isset($_GET["ver"])) {

        echo "<h2>TODAS LAS RESERVAS</h2>";

        if (count($_SESSION["libros"]) > 0) {

            echo "<ul>";

            foreach ($_SESSION["libros"] as $i => $libro) {

                echo "<li>";

                echo "Reserva " . ($i + 1) . " | ";

                echo "Nombre: " . htmlspecialchars($libro["nombre"]) . " | ";

                echo "Título: " . htmlspecialchars($libro["titulo"]) . " | ";

                echo "Fecha: " . htmlspecialchars($libro["fecha"]);

                echo "</li>";
            }

            echo "</ul>";
        } else {

            echo "<p>No hay libros registrados.</p>";
        }
    }
    ?>

</body>

</html>