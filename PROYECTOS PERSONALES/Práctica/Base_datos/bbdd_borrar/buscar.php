<?php

require_once __DIR__ . "/configuracion/conexion.php";

$resultados = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fecha = mysqli_real_escape_string($conn, $_POST["fecha"]);
    $nombre = mysqli_real_escape_string($conn, trim($_POST["nombre"]));

    $sql = "SELECT * FROM portatil WHERE vendido = 1";

    # buscar por fecha
    if ($fecha != "") {
        $sql .= " AND fecha = '$fecha'";
    }

    # buscar por nombre
    if ($nombre != "") {
        $sql .= " AND nombre LIKE '%$nombre%'";
    }

    $resultados = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar portátiles</title>
</head>

<body>

    <h1>BUSCAR PORTÁTILES</h1>

    <form method="POST">

        Fecha:
        <input type="date" name="fecha">

        <br><br>

        Nombre:
        <input type="text" name="nombre">

        <br><br>

        <button type="submit">Buscar</button>

    </form>

    <br>

    <?php

    if ($resultados !== null) {

        if (mysqli_num_rows($resultados) > 0) {

            echo "<table border='1' cellpadding='8'>";

            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Fecha</th>";
            echo "<th>Nombre</th>";
            echo "<th>Vendido</th>";
            echo "<th>Precio</th>";
            echo "</tr>";

            while ($fila = mysqli_fetch_assoc($resultados)) {

                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila["id"]) . "</td>";
                echo "<td>" . date("d-m-Y", strtotime($fila["fecha"])) . "</td>";
                echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
                echo "<td>" . ($fila["vendido"] ? "Sí" : "No") . "</td>";
                echo "<td>" . htmlspecialchars($fila["precio"]) . " €</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {

            echo "<p>No hay resultados para esa búsqueda.</p>";
        }
    }

    mysqli_close($conn);

    ?>

    <br>

    <a href="index.php">Volver al menú</a>

</body>

</html>