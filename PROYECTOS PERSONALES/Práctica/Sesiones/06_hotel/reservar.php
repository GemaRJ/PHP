<?php
session_start();

# si no existe el array de entradas, lo creamos
if (!isset($_SESSION["habitaciones"])) {
    $_SESSION["habitaciones"] = [];
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    # comprobamos el máximo de 100 entradas
    if (count($_SESSION["habitaciones"]) >= 100) {

        $mensaje = "No se pueden registrar más habitaciones. Máximo 100.";
    } else {

        # recogemos y limpiamos datos
        $nombre = htmlspecialchars(trim($_POST["nombre"]));
        $dia = htmlspecialchars(trim($_POST["dia"]));
        $habitacion = htmlspecialchars(trim($_POST["habitacion"]));

        # comprobamos que no estén vacíos
        if ($nombre == "" || $dia == "" || $habitacion == "") {

            $mensaje = "Todos los campos son obligatorios.";
        } else {

            # guardamos la entrada en la sesión
            $_SESSION["habitaciones"][] = [
                "nombre" => $nombre,
                "dia" => $dia,
                "habitacion" => $habitacion
            ];

            $mensaje = "Habitaciín registrada correctamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reservar habitación</title>
</head>

<body>

    <h1>RESERVAR HABITACIÓN</h1>

    <?php
    if ($mensaje != "") {
        echo "<p>" . htmlspecialchars($mensaje) . "</p>";
    }
    ?>

    <form action="reservar.php" method="POST">

        Nombre:
        <br>
        <input type="text" name="nombre" required>

        <br><br>

        Día de entrada:
        <br>
        <input type="date" name="dia" required>

        <br><br>

        Habitación:
        <br>
        <input type="number" name="habitacion" required>

        <br><br>

        <input type="submit" value="Reservar">

    </form>

    <br>

    <a href="index.php">Volver al menú</a>

</body>

</html>