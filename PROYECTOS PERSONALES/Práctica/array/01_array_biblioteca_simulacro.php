<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio Biblioteca Resuelto</title>
</head>

<body>

    <h1>Ejercicio: Gestión de Biblioteca</h1>

    <?php

    // ARRAY DE LIBROS
    $libros = [
        [
            'titulo' => 'Cien años de soledad',
            'autor' => 'Gabriel García Márquez',
            'genero' => 'Realismo mágico',
            'precio' => 25.99,
            'año' => 1967
        ],
        [
            'titulo' => '1984',
            'autor' => 'George Orwell',
            'genero' => 'Ciencia ficción',
            'precio' => 19.50,
            'año' => 1949
        ],
        [
            'titulo' => 'Don Quijote de la Mancha',
            'autor' => 'Miguel de Cervantes',
            'genero' => 'Novela',
            'precio' => 30.00,
            'año' => 1605
        ],
        [
            'titulo' => 'Fahrenheit 451',
            'autor' => 'Ray Bradbury',
            'genero' => 'Ciencia ficción',
            'precio' => 18.75,
            'año' => 1953
        ],
        [
            'titulo' => 'La casa de los espíritus',
            'autor' => 'Isabel Allende',
            'genero' => 'Realismo mágico',
            'precio' => 22.30,
            'año' => 1982
        ]
    ];


    // =====================================================
    // 1. MOSTRAR LIBROS ORDENADOS POR TÍTULO
    // =====================================================

    usort($libros, function ($a, $b) {
        return strcmp($a['titulo'], $b['titulo']);
    });

    echo "<h2>1. Libros ordenados por título</h2>";

    echo "<table border='1' cellpadding='8'>";
    echo "<tr>";
    echo "<th>Título</th>";
    echo "<th>Autor</th>";
    echo "<th>Género</th>";
    echo "<th>Precio</th>";
    echo "<th>Año</th>";
    echo "</tr>";

    foreach ($libros as $libro) {
        echo "<tr>";
        echo "<td>" . $libro['titulo'] . "</td>";
        echo "<td>" . $libro['autor'] . "</td>";
        echo "<td>" . $libro['genero'] . "</td>";
        echo "<td>" . $libro['precio'] . " €</td>";
        echo "<td>" . $libro['año'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";


    // =====================================================
    // 2. CALCULAR PRECIO MEDIO
    // =====================================================

    $precios = array_column($libros, 'precio');

    $sumaPrecios = array_sum($precios);

    $precioMedio = $sumaPrecios / count($precios);

    echo "<h2>2. Precio medio de los libros</h2>";
    echo "<p>El precio medio es: <strong>" . number_format($precioMedio, 2) . " €</strong></p>";


    // =====================================================
    // 3. LIBROS CON PRECIO SUPERIOR A LA MEDIA
    // =====================================================

    $librosSuperiores = array_filter($libros, function ($libro) use ($precioMedio) {
        return $libro['precio'] > $precioMedio;
    });

    echo "<h2>3. Libros con precio superior al precio medio</h2>";

    echo "<table border='1' cellpadding='8'>";
    echo "<tr>";
    echo "<th>Título</th>";
    echo "<th>Precio</th>";
    echo "</tr>";

    foreach ($librosSuperiores as $libro) {
        echo "<tr>";
        echo "<td>" . $libro['titulo'] . "</td>";
        echo "<td>" . $libro['precio'] . " €</td>";
        echo "</tr>";
    }

    echo "</table>";


    // =====================================================
    // 4. CONTAR LIBROS POR GÉNERO
    // =====================================================

    $generos = array_column($libros, 'genero');

    $contadorGeneros = array_count_values($generos);

    echo "<h2>4. Cantidad de libros por género</h2>";

    echo "<table border='1' cellpadding='8'>";
    echo "<tr>";
    echo "<th>Género</th>";
    echo "<th>Total</th>";
    echo "</tr>";

    foreach ($contadorGeneros as $genero => $total) {
        echo "<tr>";
        echo "<td>" . $genero . "</td>";
        echo "<td>" . $total . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    ?>

</body>

</html>