<?php

require_once __DIR__ . "/configuracion/conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fecha = mysqli_real_escape_string($conn, $_POST["fecha"]);
    $nombre = mysqli_real_escape_string($conn, trim($_POST["nombre"]));
    $precio = (int) $_POST["precio"];
    $vendido = isset($_POST["vendido"]) ? 1 : 0;

    $sql = "INSERT INTO portatil (fecha, nombre, vendido, precio)
            VALUES ('$fecha', '$nombre', $vendido, $precio)";

    if (mysqli_query($conn, $sql)) {
        $mensaje = "Portátil registrado correctamente.";
    } else {
        $mensaje = "Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Alta de portátiles</title>
</head>

<body>

    <h1>DAR DE ALTA UN PORTÁTIL</h1>

    <?php
    if ($mensaje != "") {
        echo "<p>" . htmlspecialchars($mensaje) . "</p>";
    }
    ?>

    <form method="POST">

        Fecha:
        <input type="date" name="fecha" required>

        <br><br>

        Nombre:
        <input type="text" name="nombre" required>

        <br><br>

        Precio:
        <input type="number" name="precio" required>

        <br><br>

        Vendido:
        <input type="checkbox" name="vendido" value="1">

        <br><br>

        <button type="submit">Guardar portátil</button>

    </form>

    <hr>

    <h2>Portátiles registrados</h2>

    <?php

    $sql2 = "SELECT * FROM portatil";

    $resultados = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($resultados) > 0) {

        echo "<table border='1' cellpadding='8'>";

        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Fecha</th>";
        echo "<th>Nombre</th>";
        echo "<th>Vendido</th>";
        echo "<th>Precio</th>";
        echo "<th>Acciones</th>";
        echo "</tr>";

        while ($fila = mysqli_fetch_assoc($resultados)) {

            echo "<tr>";

            echo "<td>" . htmlspecialchars($fila["id"]) . "</td>";
            echo "<td>" . date("d-m-Y", strtotime($fila["fecha"])) . "</td>";
            echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
            echo "<td>" . ($fila["vendido"] ? "Sí" : "No") . "</td>";
            echo "<td>" . htmlspecialchars($fila["precio"]) . " €</td>";
            echo "<td><a href='borrar.php?id=" . $fila["id"] . "'>Borrar</a></td>";

            echo "</tr>";
        }

        echo "</table>";
    } else {

        echo "<p>No hay portátiles registrados.</p>";
    }

    mysqli_close($conn);

    ?>

    <br>

    <a href="index.php">Volver al menú</a>

</body>

</html>