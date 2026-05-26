<?php

require_once __DIR__ . "/configuracion/conexion.php";

/** @var mysqli $conn */

$resultado = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    # recogemos y limpiamos búsqueda
    $busqueda = mysqli_real_escape_string($conn, trim($_POST["busqueda"]));

    # consulta SQL
    $sql = "SELECT * FROM productos
            WHERE nombre LIKE '%$busqueda%'
            OR id = '$busqueda'";

    # ejecutamos consulta
    $resultado = mysqli_query($conn, $sql);

    # mostrar error si falla
    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar productos</title>
</head>

<body>

    <h1>BUSCAR PRODUCTOS</h1>

    <form action="buscar.php" method="POST">

        Buscar producto:
        <br>

        <input type="text" name="busqueda" placeholder="ID o nombre del producto" required>

        <br><br>

        <input type="submit" value="Buscar">

    </form>

    <br>

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
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {

        echo "<p>No se encontraron productos.</p>";
    }
    ?>

    <br>

    <a href="index.php">Volver al menú</a>

</body>

</html>