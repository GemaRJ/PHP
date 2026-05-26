<?php
session_start();


if (!isset($_SESSION["entradas"])) {
    $_SESSION["entradas"] = [];
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


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
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar entrada</title>
    <link rel="stylesheet" href="style.css">

<body>

    <h1>RESERVAR ENTRADA CINE</h1>

    <?php
    if ($mensaje != "") {
        echo "<p>" . htmlspecialchars($mensaje) . "</p>";
    }
    ?>

    <form action="reservar.php" method="POST">

        Nombre:
        <input type="text" name="nombre" required>

        <br><br>

        Día:
        <input type="date" name="dia" required>

        <br><br>

        Hora:
        <input type="time" name="hora" required>

        <br><br>

        <input type="submit" value="Reservar entrada">

    </form>

    <br>

    <a href="index.php">Volver al menú</a>

</body>

</html>