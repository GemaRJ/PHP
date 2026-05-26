<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Biblioteca con Base de Datos</title>
</head>

<body>

    <h1>Gestión de Biblioteca con MySQL</h1>

    <?php

    require_once __DIR__ . "/configuracion/conexion.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $titulo = mysqli_real_escape_string($conexion, trim($_POST["titulo"]));
        $autor = mysqli_real_escape_string($conexion, trim($_POST["autor"]));
        $genero = mysqli_real_escape_string($conexion, trim($_POST["genero"]));
        $precio = floatval($_POST["precio"]);
        $anio = intval($_POST["anio"]);

        $sqlInsert = "INSERT INTO libros 
                      (titulo, autor, genero, precio, año_publicacion)
                      VALUES 
                      ('$titulo', '$autor', '$genero', $precio, $anio)";

        mysqli_query($conexion, $sqlInsert);

        echo "<p><strong>Libro añadido correctamente.</strong></p>";
    }

    ?>

    <h2>Añadir libro</h2>

    <form method="POST">

        <label>Título:</label><br>
        <input type="text" name="titulo" required><br><br>

        <label>Autor:</label><br>
        <input type="text" name="autor" required><br><br>

        <label>Género:</label><br>
        <input type="text" name="genero" required><br><br>

        <label>Precio:</label><br>
        <input type="number" step="any" name="precio" required><br><br>

        <label>Año publicación:</label><br>
        <input type="number" name="anio" required><br><br>

        <button type="submit">Guardar libro</button>

    </form>

    <hr>

    <?php

    $sql = "SELECT * FROM libros ORDER BY titulo";
    $resultado = mysqli_query($conexion, $sql);

    echo "<h2>1. Listado de libros</h2>";

    echo "<table border='1' cellpadding='8'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Título</th>";
    echo "<th>Autor</th>";
    echo "<th>Género</th>";
    echo "<th>Precio</th>";
    echo "<th>Año publicación</th>";
    echo "</tr>";

    while ($libro = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($libro["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($libro["titulo"]) . "</td>";
        echo "<td>" . htmlspecialchars($libro["autor"]) . "</td>";
        echo "<td>" . htmlspecialchars($libro["genero"]) . "</td>";
        echo "<td>" . htmlspecialchars($libro["precio"]) . " €</td>";
        echo "<td>" . htmlspecialchars($libro["año_publicacion"]) . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    $sqlMedia = "SELECT AVG(precio) AS precio_medio FROM libros";
    $resultadoMedia = mysqli_query($conexion, $sqlMedia);
    $filaMedia = mysqli_fetch_assoc($resultadoMedia);
    $precioMedio = $filaMedia["precio_medio"];

    echo "<h2>2. Precio medio de los libros</h2>";
    echo "<p>El precio medio es: <strong>" . number_format($precioMedio, 2) . " €</strong></p>";

    $sqlSuperiores = "SELECT * FROM libros
                      WHERE precio > (SELECT AVG(precio) FROM libros)";

    $resultadoSuperiores = mysqli_query($conexion, $sqlSuperiores);

    echo "<h2>3. Libros con precio superior al precio medio</h2>";

    echo "<table border='1' cellpadding='8'>";
    echo "<tr>";
    echo "<th>Título</th>";
    echo "<th>Autor</th>";
    echo "<th>Precio</th>";
    echo "</tr>";

    while ($libro = mysqli_fetch_assoc($resultadoSuperiores)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($libro["titulo"]) . "</td>";
        echo "<td>" . htmlspecialchars($libro["autor"]) . "</td>";
        echo "<td>" . htmlspecialchars($libro["precio"]) . " €</td>";
        echo "</tr>";
    }

    echo "</table>";

    $sqlGeneros = "SELECT genero, COUNT(*) AS total
                   FROM libros
                   GROUP BY genero";

    $resultadoGeneros = mysqli_query($conexion, $sqlGeneros);

    echo "<h2>4. Cantidad de libros por género</h2>";

    echo "<table border='1' cellpadding='8'>";
    echo "<tr>";
    echo "<th>Género</th>";
    echo "<th>Total</th>";
    echo "</tr>";

    while ($fila = mysqli_fetch_assoc($resultadoGeneros)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila["genero"]) . "</td>";
        echo "<td>" . htmlspecialchars($fila["total"]) . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    mysqli_close($conexion);

    ?>

</body>

</html>