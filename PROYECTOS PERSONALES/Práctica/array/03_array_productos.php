<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio Productos Resuelto</title>
</head>

<body>

    <h1>Ejercicio: Gestión de Productos</h1>

    <?php

    // ARRAY DE PRODUCTOS
    $productos = [

        [
            'nombre' => 'Portátil Lenovo',
            'categoria' => 'Informática',
            'precio' => 799.99,
            'stock' => 12,
            'marca' => 'Lenovo'
        ],

        [
            'nombre' => 'iPhone 15',
            'categoria' => 'Telefonía',
            'precio' => 1199.95,
            'stock' => 5,
            'marca' => 'Apple'
        ],

        [
            'nombre' => 'Auriculares Sony',
            'categoria' => 'Audio',
            'precio' => 89.99,
            'stock' => 20,
            'marca' => 'Sony'
        ],

        [
            'nombre' => 'Monitor LG',
            'categoria' => 'Informática',
            'precio' => 249.50,
            'stock' => 7,
            'marca' => 'LG'
        ],

        [
            'nombre' => 'Samsung Galaxy',
            'categoria' => 'Telefonía',
            'precio' => 999.99,
            'stock' => 9,
            'marca' => 'Samsung'
        ]

    ];


    // =====================================================
    // 1. PRODUCTOS ORDENADOS POR PRECIO
    // =====================================================

    usort($productos, function ($a, $b) {
        return strcmp($a['nombre'], $b['nombre']);
    });

    echo "<h2>1. Productos ordenados por Precio</h2>";

    echo "<table border='1' cellpadding='8'>";

    echo "<tr>";
    echo "<th>Nombre</th>";
    echo "<th>Categoría</th>";
    echo "<th>Precio</th>";
    echo "<th>Stock</th>";
    echo "<th>Marca</th>";
    echo "</tr>";

    foreach ($productos as $producto) {

        echo "<tr>";

        echo "<td>" . $producto['nombre'] . "</td>";

        echo "<td>" . $producto['categoria'] . "</td>";

        echo "<td>" . $producto['precio'] . " €</td>";

        echo "<td>" . $producto['stock'] . "</td>";

        echo "<td>" . $producto['marca'] . "</td>";

        echo "</tr>";
    }

    echo "</table>";


    // =====================================================
    // 2. PRECIO MEDIO
    // =====================================================

    $precios = array_column($productos, 'precio');

    $sumaPrecios = array_sum($precios);

    $precioMedio = $sumaPrecios / count($precios);

    echo "<h2>2. Precio medio de los productos</h2>";

    echo "<p>";
    echo "El precio medio es: ";
    echo "<strong>" . number_format($precioMedio, 2) . " €</strong>";
    echo "</p>";


    // =====================================================
    // 3. BUSCAR PRODUCTOS POR PRECIO
    // =====================================================

    $precioBusqueda = 500;

    $productosEncontrados = array_filter($productos, function ($producto) use ($precioBusqueda) {

        return $producto['precio'] > $precioBusqueda;
    });

    echo "<h2>3. Productos con precio superior a $precioBusqueda €</h2>";

    echo "<table border='1' cellpadding='8'>";

    echo "<tr>";
    echo "<th>Nombre</th>";
    echo "<th>Precio</th>";
    echo "<th>Marca</th>";
    echo "</tr>";

    foreach ($productosEncontrados as $producto) {

        echo "<tr>";

        echo "<td>" . $producto['nombre'] . "</td>";

        echo "<td>" . $producto['precio'] . " €</td>";

        echo "<td>" . $producto['marca'] . "</td>";

        echo "</tr>";
    }

    echo "</table>";


    // =====================================================
    // 4. CONTAR PRODUCTOS POR CATEGORÍA
    // =====================================================

    $categorias = array_column($productos, 'categoria');

    $contadorCategorias = array_count_values($categorias);

    echo "<h2>4. Cantidad de productos por categoría</h2>";

    echo "<table border='1' cellpadding='8'>";

    echo "<tr>";
    echo "<th>Categoría</th>";
    echo "<th>Total</th>";
    echo "</tr>";

    foreach ($contadorCategorias as $categoria => $total) {

        echo "<tr>";

        echo "<td>" . $categoria . "</td>";

        echo "<td>" . $total . "</td>";

        echo "</tr>";
    }

    echo "</table>";

    ?>

</body>

</html>