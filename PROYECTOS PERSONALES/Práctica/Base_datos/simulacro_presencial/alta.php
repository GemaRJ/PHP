<?php

require_once __DIR__ . "/configuracion/conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = mysqli_real_escape_string($conn, trim($_POST["nombre"]));

    $cantidad = (int) $_POST["cantidad"];

    $precio = (float) $_POST["precio"];

    $sql = "INSERT INTO productos (nombre, cantidad, precio)
            VALUES ('$nombre', $cantidad, $precio)";

    if (mysqli_query($conn, $sql)) {

        $mensaje = "Producto registrado correctamente.";
    } else {

        $mensaje = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Añadir producto</title>
</head>

<body>

    <h1>AÑADIR PRODUCTO</h1>

    <?php
    if ($mensaje != "") {
        echo "<p>" . htmlspecialchars($mensaje) . "</p>";
    }
    ?>

    <form action="alta.php" method="POST">

        Nombre:
        <br>
        <input type="text" name="nombre" required>

        <br><br>

        Cantidad:
        <br>
        <input type="number" name="cantidad" required>

        <br><br>

        Precio:
        <br>
        <input type="number" step="0.01" name="precio" required>

        <br><br>

        <input type="submit" value="Añadir producto">

    </form>

    <br>

    <a href="index.php">Volver al menú</a>

</body>

</html>