<?php

$conn = mysqli_connect("localhost", "root", "", "examen2");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

$mensaje = "";
$resultadoBusqueda = null;
$mostrarTodos = false;

// Registrar ordenador
if (isset($_POST["enviar"])) {

    $fecha = mysqli_real_escape_string($conn, $_POST["fecha"]);
    $nombre = mysqli_real_escape_string($conn, trim($_POST["nombre"]));
    $precio = (int) $_POST["precio"];
    $vendido = isset($_POST["vendido"]) ? 1 : 0;

    $sql = "INSERT INTO ordenador (fecha, nombre, vendido, precio)
            VALUES ('$fecha', '$nombre', '$vendido', '$precio')";

    if (mysqli_query($conn, $sql)) {
        $mensaje = "Ordenador registrado correctamente.";
    } else {
        $mensaje = "Error: " . mysqli_error($conn);
    }
}

// Buscar por fecha SOLO vendidos
if (isset($_POST["buscar"])) {

    $fechaBuscar = mysqli_real_escape_string($conn, $_POST["fechaBuscar"]);

    $sqlBuscar = "SELECT * FROM ordenador
                  WHERE fecha = '$fechaBuscar'
                  AND vendido = 1";

    $resultadoBusqueda = mysqli_query($conn, $sqlBuscar);
}

// Mostrar todos
if (isset($_POST["mostrar"])) {
    $mostrarTodos = true;
}

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

            <input type="submit" name="enviar" value="Registrar PC en DB">

        </form>

        <?php
        if ($mensaje != "") {
            echo "<p><strong>" . htmlspecialchars($mensaje) . "</strong></p>";
        }
        ?>

    </div>

    <hr>

    <div class="container">

        <h2>BUSCAR / MOSTRAR</h2>

        <form method="POST" style="display: flex; flex-direction: column; max-width: 300px;">

            Buscar por fecha:
            <input type="date" name="fechaBuscar">

            <br>

            <input type="submit" name="buscar" value="BUSCAR POR FECHA">

            <hr>

            <input type="submit" name="mostrar" value="MOSTRAR TODOS PC en DB">

        </form>

    </div>

    <hr>

    <?php

    // Mostrar resultado búsqueda
    if ($resultadoBusqueda !== null) {

        echo "<h2>Resultados de búsqueda</h2>";

        if (mysqli_num_rows($resultadoBusqueda) > 0) {

            echo "<ul>";

            while ($fila = mysqli_fetch_assoc($resultadoBusqueda)) {

                echo "<li style='border-bottom:1px solid #ccc; padding:10px 0;'>";
                echo "ID: " . htmlspecialchars($fila["id"]) . " | ";
                echo "Nombre: " . htmlspecialchars($fila["nombre"]) . " | ";
                echo "Fecha: " . date("d-m-Y", strtotime($fila["fecha"])) . " | ";
                echo "Vendido: " . ($fila["vendido"] ? "Sí" : "No") . " | ";
                echo "Precio: " . htmlspecialchars($fila["precio"]) . " €";
                echo "</li>";
            }

            echo "</ul>";
        } else {

            echo "<p>No hay ordenadores vendidos en esa fecha.</p>";
        }
    }

    // Mostrar todos
    if ($mostrarTodos) {

        $sqlTodos = "SELECT * FROM ordenador";
        $resultadoTodos = mysqli_query($conn, $sqlTodos);

        echo "<h2>Todos los ordenadores</h2>";

        if (mysqli_num_rows($resultadoTodos) > 0) {

            echo "<ul>";

            while ($fila = mysqli_fetch_assoc($resultadoTodos)) {

                echo "<li style='border-bottom:1px solid #ccc; padding:10px 0;'>";
                echo "ID: " . htmlspecialchars($fila["id"]) . " | ";
                echo "Nombre: " . htmlspecialchars($fila["nombre"]) . " | ";
                echo "Fecha: " . date("d-m-Y", strtotime($fila["fecha"])) . " | ";
                echo "Vendido: " . ($fila["vendido"] ? "Sí" : "No") . " | ";
                echo "Precio: " . htmlspecialchars($fila["precio"]) . " €";
                echo "</li>";
            }

            echo "</ul>";
        } else {

            echo "<p>No hay ordenadores registrados.</p>";
        }
    }

    mysqli_close($conn);

    ?>

</body>

</html>