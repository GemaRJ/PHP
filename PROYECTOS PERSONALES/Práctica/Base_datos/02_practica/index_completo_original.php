<?php
$conexion = mysqli_connect("localhost", "root", "rootroot", "practica_portatiles");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$contenido = "";

if (isset($_POST["enviar"])) {

    $nombre = mysqli_real_escape_string($conexion, $_POST["nombre"]);
    $precio = mysqli_real_escape_string($conexion, $_POST["precio"]);
    $fecha = date("Y-m-d");
    $vendido = 0;

    $sql = "INSERT INTO portatil (fecha, nombre, vendido, precio)
            VALUES ('$fecha', '$nombre', '$vendido', '$precio')";

    if (mysqli_query($conexion, $sql)) {
        $contenido = "PC AGREGADO";
    } else {
        $contenido = "Error al guardar: " . mysqli_error($conexion);
    }
}

if (isset($_POST["mostrar"])) {

    $sql = "SELECT * FROM portatil";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $contenido = "<ul>";

        while ($row = mysqli_fetch_assoc($resultado)) {
            $contenido .= "<li>";
            $contenido .= "ID: " . $row["id"] . " | ";
            $contenido .= "Fecha: " . date("d-m-Y", strtotime($row["fecha"])) . " | ";
            $contenido .= "Nombre: " . $row["nombre"] . " | ";
            $contenido .= "Vendido: " . ($row["vendido"] ? "Sí" : "No") . " | ";
            $contenido .= "Precio: " . $row["precio"];
            $contenido .= "</li><hr>";
        }

        $contenido .= "</ul>";
    } else {
        $contenido = "No hay PC registrados.";
    }
}

/* if (isset($_POST["mostrarIdbtn"])) {

    $id = mysqli_real_escape_string($conexion, $_POST["mostrarId"]);

    $sql = "SELECT * FROM portatil WHERE id = '$id'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $contenido = "<ul>";

        while ($row = mysqli_fetch_assoc($resultado)) {
            $contenido .= "<li>";
            $contenido .= "ID: " . $row["id"] . " | ";
            $contenido .= "Fecha: " . date("d-m-Y", strtotime($row["fecha"])) . " | ";
            $contenido .= "Nombre: " . $row["nombre"] . " | ";
            $contenido .= "Vendido: " . ($row["vendido"] ? "Sí" : "No") . " | ";
            $contenido .= "Precio: " . $row["precio"];
            $contenido .= "</li><hr>";
        }

        $contenido .= "</ul>";
    } else {
        $contenido = "No hay PC registrados con ese ID.";
    }
} */

# ===== BUSCAR POR FECHA =====
if (isset($_POST["buscarFecha"])) {

    $fecha = mysqli_real_escape_string($conexion, $_POST["fecha"]);

    $sql = "SELECT * FROM portatil WHERE fecha = '$fecha'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $contenido = "<ul>";

        while ($row = mysqli_fetch_assoc($resultado)) {
            $contenido .= "<li>";
            $contenido .= "ID: " . $row["id"] . " | ";
            $contenido .= "Fecha: " . date("d-m-Y", strtotime($row["fecha"])) . " | ";
            $contenido .= "Nombre: " . $row["nombre"] . " | ";
            $contenido .= "Vendido: " . ($row["vendido"] ? "Sí" : "No") . " | ";
            $contenido .= "Precio: " . $row["precio"];
            $contenido .= "</li><hr>";
        }

        $contenido .= "</ul>";
    } else {
        $contenido = "No hay registros para esa fecha.";
    }
}


if (isset($_POST["ocultar"])) {
    $contenido = "";
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tienda de Ordenadores</title>
</head>

<body>

    <div class="container">
        <h1>TIENDA DE ORDENADORES</h1>

        <h2>REGISTRAR ORDENADOR</h2>

        <form action="" method="POST">
            Nombre <input type="text" name="nombre" required>
            Precio <input type="number" name="precio" required>
            <input type="submit" name="enviar" value="Registrar PC en DB">
        </form>
    </div>

    <div class="container">
        <h2>MOSTRAR/OCULTAR</h2>

        <form action="" method="POST" style="display: flex; flex-direction:column">

            Elige buscar por fecha para mostrar:
            <input type="date" name="fecha" style="max-width: fit-content;">

            <input type="submit" name="buscarFecha" value="BUSCAR PC POR FECHA" style="max-width: fit-content;">

            <hr>

            <input type="submit" name="mostrar" value="MOSTRAR TODOS PC en DB" style="max-width: fit-content;">

            <hr>

            <input type="submit" name="ocultar" value="OCULTAR DATOS" style="max-width: fit-content;">
        </form>
    </div>

    <div>
        <?php echo $contenido; ?>
    </div>

</body>

</html>