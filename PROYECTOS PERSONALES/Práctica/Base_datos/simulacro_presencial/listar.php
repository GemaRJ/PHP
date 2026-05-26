<?php

require_once __DIR__ . "/configuracion/conexion.php";

/** @var mysqli $conn */

$sql = "SELECT * FROM productos";

$resultado = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mostrar productos</title>
</head>

<body>

    <h1>MOSTRAR TODOS LOS PRODUCTOS</h1>

    <?php

    if ($resultado && mysqli_num_rows($resultado) > 0) {

        echo "<table border='1' cellpadding='10'>";

        echo "<tr>";

        echo "<th>ID</th>";
        echo "<th>Nombre</th>";
        echo "<th>Cantidad</th>";
        echo "<th>Precio</th>";

        echo "</tr>";

        while ($fila = mysqli_fetch_assoc($resultado)) {

            echo "<tr>";

            echo "<td>" . htmlspecialchars($fila["id"]) . "</td>";

            echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";

            echo "<td>" . htmlspecialchars($fila["cantidad"]) . "</td>";

            echo "<td>" . htmlspecialchars($fila["precio"]) . "</td>";

            echo "</tr>";
        }

        echo "</table>";
    } else {

        echo "<p>No hay productos registrados.</p>";
    }
    ?>

    <br>

    <a href="index.php">Volver al menú</a>

</body>

</html>