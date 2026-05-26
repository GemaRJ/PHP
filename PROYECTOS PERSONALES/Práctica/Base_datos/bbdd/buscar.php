<?php

require_once __DIR__ . "/configuracion/conexion.php";

$resultados = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fecha = mysqli_real_escape_string($conn, $_POST["fecha"]);

    $sql = "SELECT * FROM ordenador 
            WHERE fecha = '$fecha' AND vendido = 1";

    $resultados = mysqli_query($conn, $sql);
}

/* BUSCAR POR FECHA O ID

$resultados = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    # recogemos y limpiamos búsqueda
    $busqueda = mysqli_real_escape_string($conn, trim($_POST["busqueda"]));

    # consulta SQL:
    # busca por fecha o por ID
    # y además solo muestra ordenadores vendidos
    $sql = "SELECT * FROM ordenador
            WHERE (fecha = '$busqueda'
            OR id = '$busqueda')
            AND vendido = 1";

    # ejecutamos consulta
    $resultados = mysqli_query($conn, $sql);

    # mostrar error si falla
    if (!$resultados) {
        die("Error en la consulta: " . mysqli_error($conn));
    }
}

*/
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar Ordenadores</title>
</head>

<body>

    <h1>Buscar ordenadores vendidos por fecha</h1>

    <form method="POST">

        Fecha:
        <input type="date" name="fecha" required>

        <br><br>

        <button type="submit">
            Buscar
        </button>

    </form>
    <!-- FORMULARIO PARA BUSCAR POR FECHA O ID

<h1>Buscar ordenadores vendidos</h1>

<form method="POST">

    Buscar:
    <input type="text" name="busqueda" required>

    <br><br>

    <button type="submit">
        Buscar
    </button>

</form>

-->
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

            echo "<p>No hay ordenadores vendidos en esa fecha.</p>";
        }
    }

    mysqli_close($conn);

    ?>

    <br>

    <a href="index.php">
        Volver al menú
    </a>

</body>

</html>