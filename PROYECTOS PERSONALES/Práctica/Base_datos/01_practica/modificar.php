<?php

$conn = mysqli_connect("localhost", "root", "", "practica_portatiles");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

$mensaje = "";

if (!isset($_GET["id"]) && !isset($_POST["id"])) {
    die("No se ha indicado ningún ID.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = (int) $_POST["id"];
    $fecha = mysqli_real_escape_string($conn, $_POST["fecha"]);
    $nombre = mysqli_real_escape_string($conn, trim($_POST["nombre"]));
    $precio = (int) $_POST["precio"];
    $vendido = isset($_POST["vendido"]) ? 1 : 0;

    $sql = "UPDATE portatil 
            SET fecha = '$fecha',
                nombre = '$nombre',
                vendido = '$vendido',
                precio = '$precio'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        $mensaje = "Portátil modificado correctamente.";
    } else {
        $mensaje = "Error: " . mysqli_error($conn);
    }
}

$id = isset($_GET["id"]) ? (int) $_GET["id"] : (int) $_POST["id"];

$sqlSelect = "SELECT * FROM portatil WHERE id = $id";
$resultado = mysqli_query($conn, $sqlSelect);

if (mysqli_num_rows($resultado) == 0) {
    die("No existe ningún portátil con ese ID.");
}

$portatil = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar portátil</title>
</head>

<body>

    <h1>Editar portátil</h1>

    <?php
    if ($mensaje != "") {
        echo "<p>" . htmlspecialchars($mensaje) . "</p>";
    }
    ?>

    <form method="POST">

        <input type="hidden" name="id" value="<?php echo htmlspecialchars($portatil["id"]); ?>">

        Fecha:
        <input type="date" name="fecha" value="<?php echo htmlspecialchars($portatil["fecha"]); ?>" required><br><br>

        Nombre:
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($portatil["nombre"]); ?>" required><br><br>

        Precio:
        <input type="number" name="precio" value="<?php echo htmlspecialchars($portatil["precio"]); ?>"
            required><br><br>

        Vendido:
        <input type="checkbox" name="vendido" value="1" <?php if ($portatil["vendido"]) echo "checked"; ?>><br><br>

        <button type="submit">Guardar cambios</button>

    </form>

    <br>

    <a href="alta.php">Volver</a>

</body>

</html>

<?php
mysqli_close($conn);
?>


<!-- 
// SOLO MODIFICAR NOMBRE

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = (int) $_POST["id"];

    $nombre = mysqli_real_escape_string(
        $conn,
        trim($_POST["nombre"])
    );

    $sql = "UPDATE portatil
            SET nombre = '$nombre'
            WHERE id = $id";

    mysqli_query($conn, $sql);
    
} -->

<!-- -- FORMULARIO SOLO CON NOMBRE 

//<form method="POS">

    <input type="hidden" name="id" value=" 
    <?php echo htmlspecialchars($portatil["id"]); ?>">

    Nombre:

    <input type="text" name="nombre" value="
    <?php echo htmlspecialchars($portatil["nombre"]); ?>" required>

    <br><br>

    <button type="submit">
        Guardar cambios
    </button>

</form // -->