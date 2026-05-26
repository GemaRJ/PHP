<?php
# 1. Conectar con el servidor y seleccionar la base de datos
$conn = mysqli_connect("localhost", "root", "rootroot", "practica_portatiles");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

# Buena práctica para tildes, ñ y caracteres especiales
mysqli_set_charset($conn, "utf8");

$mensaje = "";
$resultados = null;

# ===== FUNCIONES =====

function alta($conn)
{
    $fecha = mysqli_real_escape_string($conn, $_POST["fecha"]);
    $nombre = mysqli_real_escape_string($conn, trim($_POST["nombre"]));
    $precio = (int) $_POST["precio"];
    $vendido = isset($_POST["vendido"]) ? 1 : 0;

    $sql = "INSERT INTO portatil (fecha, nombre, vendido, precio)
            VALUES ('$fecha', '$nombre', '$vendido', '$precio')";

    if (mysqli_query($conn, $sql)) {
        return "Portátil registrado correctamente.";
    } else {
        return "Error: " . mysqli_error($conn);
    }
}

function buscarPorFecha($conn)
{
    $fechaBuscar = mysqli_real_escape_string($conn, $_POST["fecha_buscar"]);
    $sql = "SELECT * FROM portatil WHERE fecha = '$fechaBuscar'";
    return mysqli_query($conn, $sql);
}

function mostrarTodos($conn)
{
    $sql = "SELECT * FROM portatil";
    return mysqli_query($conn, $sql);
}

function borrarPorId($conn)
{
    $id = (int) $_POST["id_borrar"];
    $sql = "DELETE FROM portatil WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn) > 0) {
            return "Portátil borrado correctamente.";
        } else {
            return "No existe ningún portátil con ese ID.";
        }
    } else {
        return "Error al borrar: " . mysqli_error($conn);
    }
}

function modificarPorId($conn)
{
    $id = (int) $_POST["id_modificar"];
    $fecha = mysqli_real_escape_string($conn, $_POST["fecha_modificar"]);
    $nombre = mysqli_real_escape_string($conn, trim($_POST["nombre_modificar"]));
    $precio = (int) $_POST["precio_modificar"];
    $vendido = isset($_POST["vendido_modificar"]) ? 1 : 0;

    $sql = "UPDATE portatil
            SET fecha='$fecha', nombre='$nombre', vendido='$vendido', precio='$precio'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn) > 0) {
            return "Portátil modificado correctamente.";
        } else {
            return "No existe ese ID o no se realizaron cambios.";
        }
    } else {
        return "Error al modificar: " . mysqli_error($conn);
    }
}

# ===== CONTROL DE BOTONES =====

if (isset($_POST["alta"])) {
    $mensaje = alta($conn);
}

if (isset($_POST["buscar"])) {
    $resultados = buscarPorFecha($conn);
}

if (isset($_POST["mostrar"])) {
    $resultados = mostrarTodos($conn);
}

if (isset($_POST["ocultar"])) {
    $resultados = null;
}

if (isset($_POST["borrar"])) {
    $mensaje = borrarPorId($conn);
}

if (isset($_POST["modificar"])) {
    $mensaje = modificarPorId($conn);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Portátiles</title>
</head>

<body>

    <h1>Gestión de Portátiles</h1>

    <?php
    if ($mensaje != "") {
        echo "<p>" . htmlspecialchars($mensaje) . "</p>";
    }
    ?>

    <h2>Dar de alta un portátil</h2>

    <form method="POST">
        Fecha: <input type="date" name="fecha" required><br><br>
        Nombre: <input type="text" name="nombre" required><br><br>
        Precio: <input type="number" name="precio" required><br><br>
        Vendido: <input type="checkbox" name="vendido" value="1"><br><br>

        <button type="submit" name="alta">Guardar</button>
    </form>

    <hr>

    <h2>Buscar por fecha</h2>

    <form method="POST">
        Fecha: <input type="date" name="fecha_buscar" required>
        <button type="submit" name="buscar">Buscar</button>
    </form>

    <hr>

    <h2>Mostrar / Ocultar</h2>

    <form method="POST">
        <button type="submit" name="mostrar">Mostrar todos</button>
        <button type="submit" name="ocultar">Ocultar</button>
    </form>

    <hr>

    <h2>Borrar por ID</h2>

    <form method="POST">
        ID: <input type="number" name="id_borrar" required>
        <button type="submit" name="borrar">Borrar</button>
    </form>

    <hr>

    <h2>Modificar por ID</h2>

    <form method="POST">
        ID: <input type="number" name="id_modificar" required><br><br>
        Nueva fecha: <input type="date" name="fecha_modificar" required><br><br>
        Nuevo nombre: <input type="text" name="nombre_modificar" required><br><br>
        Nuevo precio: <input type="number" name="precio_modificar" required><br><br>
        Vendido: <input type="checkbox" name="vendido_modificar" value="1"><br><br>

        <button type="submit" name="modificar">Modificar</button>
    </form>

    <hr>

    <?php
    if ($resultados !== null) {

        echo "<h2>Resultados</h2>";

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
            echo "<p>No hay resultados.</p>";
        }
    }

    mysqli_close($conn);
    ?>

</body>

</html>