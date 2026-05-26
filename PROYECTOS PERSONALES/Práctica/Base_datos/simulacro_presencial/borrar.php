<?php

require_once __DIR__ . "/configuracion/conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = (int) $_POST["id"];

    $sql = "DELETE FROM productos
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {

        $mensaje = "Producto borrado correctamente.";
    } else {

        $mensaje = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Borrar producto</title>
</head>

<body>

    <h1>BORRAR PRODUCTO</h1>

    <?php
    if ($mensaje != "") {
        echo "<p>" . htmlspecialchars($mensaje) . "</p>";
    }
    ?>

    <form action="borrar.php" method="POST">

        ID del producto:
        <br>

        <input type="number" name="id" required>

        <br><br>

        <input type="submit" value="Borrar producto">

    </form>

    <br>

    <a href="index.php">Volver al menú</a>

</body>

</html>