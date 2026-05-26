<?php
$conn = mysqli_connect("localhost", "root", "", "practica_portatiles");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

$resultados = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fecha = mysqli_real_escape_string($conn, $_POST["fecha"]);
    $nombre = mysqli_real_escape_string($conn, trim($_POST["nombre"]));

    if ($fecha != "" && $nombre != "") {
        $sql = "SELECT * FROM portatil
                WHERE fecha = '$fecha' 
                AND nombre LIKE '%$nombre%'";
    } elseif ($fecha != "") {
        $sql = "SELECT * FROM portatil
                WHERE fecha = '$fecha'";
    } elseif ($nombre != "") {
        $sql = "SELECT * FROM portatil
                WHERE nombre LIKE '%$nombre%'";
    }

    /*
    SOLO BUSCAR POR FECHA:

    $sql = "SELECT * FROM portatil WHERE fecha = '$fecha'";
    */

    if (isset($sql)) {
        $resultados = mysqli_query($conn, $sql);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar portátil</title>
</head>

<body>

    <h1>Buscar portátiles por fecha o nombre</h1>

    <form method="POST">
        Fecha: <input type="date" name="fecha"><br><br>
        Nombre: <input type="text" name="nombre"><br><br>

        <button type="submit">Buscar</button>
    </form>

    <br>

    <?php
    if ($resultados !== null) {

        if (mysqli_num_rows($resultados) > 0) {

            echo "<table border='1'>";
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
                echo "<td>" . htmlspecialchars($fila["precio"]) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No hay resultados para esa búsqueda.</p>";
        }
    }
    ?>

    <br>
    <a href="index.php">Volver al menú</a>

</body>

</html>

<?php
mysqli_close($conn);
?>