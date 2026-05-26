<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio Videojuegos Resuelto</title>
</head>

<body>

    <h1>Ejercicio: Gestión de Videojuegos</h1>

    <?php

    // ARRAY DE VIDEOJUEGOS
    $videojuegos = [
        [
            'nombre' => 'Minecraft',
            'empresa' => 'Mojang',
            'plataforma' => 'PC',
            'precio' => 26.95,
            'anio' => 2011
        ],
        [
            'nombre' => 'The Legend of Zelda',
            'empresa' => 'Nintendo',
            'plataforma' => 'Nintendo Switch',
            'precio' => 59.99,
            'anio' => 2017
        ],
        [
            'nombre' => 'FIFA 24',
            'empresa' => 'EA Sports',
            'plataforma' => 'PlayStation',
            'precio' => 69.99,
            'anio' => 2023
        ],
        [
            'nombre' => 'Forza Horizon 5',
            'empresa' => 'Playground Games',
            'plataforma' => 'Xbox',
            'precio' => 49.99,
            'anio' => 2021
        ],
        [
            'nombre' => 'Animal Crossing',
            'empresa' => 'Nintendo',
            'plataforma' => 'Nintendo Switch',
            'precio' => 54.99,
            'anio' => 2020
        ]
    ];


    // =====================================================
    // 1. MOSTRAR VIDEOJUEGOS ORDENADOS POR PLATAFORMA
    // =====================================================

    usort($videojuegos, function ($a, $b) {
        return strcmp($a['plataforma'], $b['plataforma']);
    });

    echo "<h2>1. Videojuegos ordenados por plataforma</h2>";

    echo "<table border='1' cellpadding='8'>";
    echo "<tr>";
    echo "<th>Nombre</th>";
    echo "<th>Empresa</th>";
    echo "<th>Plataforma</th>";
    echo "<th>Precio</th>";
    echo "<th>Año</th>";
    echo "</tr>";

    foreach ($videojuegos as $juego) {

        echo "<tr>";

        echo "<td>" . $juego['nombre'] . "</td>";

        echo "<td>" . $juego['empresa'] . "</td>";

        echo "<td>" . $juego['plataforma'] . "</td>";

        echo "<td>" . $juego['precio'] . " €</td>";

        echo "<td>" . $juego['anio'] . "</td>";

        echo "</tr>";
    }

    echo "</table>";


    // =====================================================
    // 2. CALCULAR PRECIO MEDIO
    // =====================================================

    $precios = array_column($videojuegos, 'precio');

    $sumaPrecios = array_sum($precios);

    $precioMedio = $sumaPrecios / count($precios);

    echo "<h2>2. Precio medio de los videojuegos</h2>";

    echo "<p>";

    echo "El precio medio es: ";

    echo "<strong>" . number_format($precioMedio, 2) . " €</strong>";

    echo "</p>";


    // =====================================================
    // 3. VIDEOJUEGOS CON PRECIO SUPERIOR A LA MEDIA
    // =====================================================

    $videojuegosSuperiores = array_filter($videojuegos, function ($juego) use ($precioMedio) {

        return $juego['precio'] > $precioMedio;
    });

    echo "<h2>3. Videojuegos con precio superior al precio medio</h2>";

    echo "<table border='1' cellpadding='8'>";

    echo "<tr>";
    echo "<th>Nombre</th>";
    echo "<th>Plataforma</th>";
    echo "<th>Precio</th>";
    echo "</tr>";

    foreach ($videojuegosSuperiores as $juego) {

        echo "<tr>";

        echo "<td>" . $juego['nombre'] . "</td>";

        echo "<td>" . $juego['plataforma'] . "</td>";

        echo "<td>" . $juego['precio'] . " €</td>";

        echo "</tr>";
    }

    echo "</table>";


    // =====================================================
    // 4. CONTAR VIDEOJUEGOS POR PLATAFORMA
    // =====================================================

    $plataformas = array_column($videojuegos, 'plataforma');

    $contadorPlataformas = array_count_values($plataformas);

    echo "<h2>4. Cantidad de videojuegos por plataforma</h2>";

    echo "<table border='1' cellpadding='8'>";

    echo "<tr>";
    echo "<th>Plataforma</th>";
    echo "<th>Total</th>";
    echo "</tr>";

    foreach ($contadorPlataformas as $plataforma => $total) {

        echo "<tr>";

        echo "<td>" . $plataforma . "</td>";

        echo "<td>" . $total . "</td>";

        echo "</tr>";
    }

    echo "</table>";

    ?>

</body>

</html>