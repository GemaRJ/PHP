<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio Biblioteca con BBDD</title>
</head>

<body>

    <h1>Ejercicio: Gestión de Biblioteca con MySQL</h1>

    <h2>Listado de libros</h2>

    <?php

    // =====================================================
    // CONEXIÓN A LA BASE DE DATOS
    // =====================================================

    $servidor = "localhost";

    $usuario = "root";

    $password = "";

    $baseDatos = "simulacro";

    $conexion = mysqli_connect($servidor, $usuario, $password, $baseDatos);

    // Comprobar conexión
    if (!$conexion) {

        die("Error de conexión: " . mysqli_connect_error());
    }

    // Mostrar correctamente acentos y ñ
    mysqli_set_charset($conexion, "utf8");


    // =====================================================
    // 1. MOSTRAR TODOS LOS LIBROS
    // =====================================================

    $sql = "SELECT * FROM libros ORDER BY titulo";

    $resultado = mysqli_query($conexion, $sql);

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

        echo "<td>" . $libro["id"] . "</td>";

        echo "<td>" . $libro["titulo"] . "</td>";

        echo "<td>" . $libro["autor"] . "</td>";

        echo "<td>" . $libro["genero"] . "</td>";

        echo "<td>" . $libro["precio"] . " €</td>";

        echo "<td>" . $libro["año_publicacion"] . "</td>";

        echo "</tr>";
    }

    echo "</table>";


    // =====================================================
    // 2. CALCULAR PRECIO MEDIO
    // =====================================================

    $sqlMedia = "SELECT AVG(precio) AS precio_medio FROM libros";

    $resultadoMedia = mysqli_query($conexion, $sqlMedia);

    $filaMedia = mysqli_fetch_assoc($resultadoMedia);

    $precioMedio = $filaMedia["precio_medio"];

    echo "<h2>Precio medio de los libros</h2>";

    echo "<p>";

    echo "El precio medio es: ";

    echo "<strong>" . number_format($precioMedio, 2) . " €</strong>";

    echo "</p>";


    // =====================================================
    // 3. LIBROS SUPERIORES AL PRECIO MEDIO
    // =====================================================

    $sqlSuperiores = "
    
    SELECT * FROM libros
    
    WHERE precio > (SELECT AVG(precio) FROM libros)
    
    ";

    $resultadoSuperiores = mysqli_query($conexion, $sqlSuperiores);

    echo "<h2>Libros con precio superior al precio medio</h2>";

    echo "<table border='1' cellpadding='8'>";

    echo "<tr>";

    echo "<th>Título</th>";

    echo "<th>Autor</th>";

    echo "<th>Precio</th>";

    echo "</tr>";

    while ($libro = mysqli_fetch_assoc($resultadoSuperiores)) {

        echo "<tr>";

        echo "<td>" . $libro["titulo"] . "</td>";

        echo "<td>" . $libro["autor"] . "</td>";

        echo "<td>" . $libro["precio"] . " €</td>";

        echo "</tr>";
    }

    echo "</table>";


    // =====================================================
    // 4. CONTAR LIBROS POR GÉNERO
    // =====================================================

    $sqlGeneros = "
    
    SELECT genero, COUNT(*) AS total
    
    FROM libros
    
    GROUP BY genero
    
    ";

    $resultadoGeneros = mysqli_query($conexion, $sqlGeneros);

    echo "<h2>Cantidad de libros por género</h2>";

    echo "<table border='1' cellpadding='8'>";

    echo "<tr>";

    echo "<th>Género</th>";

    echo "<th>Total</th>";

    echo "</tr>";

    while ($fila = mysqli_fetch_assoc($resultadoGeneros)) {

        echo "<tr>";

        echo "<td>" . $fila["genero"] . "</td>";

        echo "<td>" . $fila["total"] . "</td>";

        echo "</tr>";
    }

    echo "</table>";


    // =====================================================
    // CERRAR CONEXIÓN
    // =====================================================

    mysqli_close($conexion);

    ?>

</body>

</html>