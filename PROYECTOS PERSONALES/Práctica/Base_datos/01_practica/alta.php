<?php
$conn = mysqli_connect("localhost", "root", "", "practica_portatiles");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

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

    <h1>Dar de alta un portátil</h1>

    <?php
    if ($mensaje != "") {
        echo "<p>" . htmlspecialchars($mensaje) . "</p>";
    }
    ?>

    <form method="POST">
        Fecha: <input type="date" name="fecha" required><br><br>
        Nombre: <input type="text" name="nombre" required><br><br>
        Precio: <input type="number" name="precio" required><br><br>
        Vendido: <input type="checkbox" name="vendido" value="1"><br><br>

        <button type="submit">Guardar</button>
    </form>

    <hr>

    <h2>Portátiles registrados</h2>

    <?php
    $sql2 = "SELECT * FROM portatil";
    $resultados = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($resultados) > 0) {

        echo "<ul>";

        while ($fila = mysqli_fetch_assoc($resultados)) {

            echo "<li style='border-bottom:1px solid #ccc; padding:10px 0;'>";
            echo "ID: " . htmlspecialchars($fila["id"]) . " | ";
            echo "Nombre: " . htmlspecialchars($fila["nombre"]) . " | ";
            echo "Fecha: " . date("d-m-Y", strtotime($fila["fecha"])) . " | ";
            echo "Vendido: " . ($fila["vendido"] ? "Sí" : "No") . " | ";
            echo "Precio: " . htmlspecialchars($fila["precio"]);
            echo " | <a href='editar.php?id=" . $fila["id"] . "'>Editar</a>";
            echo " | <a href='borrar.php?id=" . $fila["id"] . "'>Borrar</a>";
            echo "</li>";
        }

        echo "</ul>";
    } else {
        echo "<p>No hay portátiles registrados.</p>";
    }

    mysqli_close($conn);
    ?>

    <br>
    <a href="index.php">Volver al menú</a>

</body>

</html>