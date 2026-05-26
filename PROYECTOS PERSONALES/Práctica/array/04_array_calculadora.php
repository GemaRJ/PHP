<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio Calculadora Resuelto</title>
</head>

<body>

    <h1>Ejercicio: Gestión de Operaciones Matemáticas</h1>

    <?php

    // ARRAY DE OPERACIONES
    $operaciones = [

        [
            'tipo' => 'Suma',
            'numero1' => 10,
            'numero2' => 5,
            'resultado' => 15
        ],

        [
            'tipo' => 'Resta',
            'numero1' => 20,
            'numero2' => 8,
            'resultado' => 12
        ],

        [
            'tipo' => 'Multiplicación',
            'numero1' => 6,
            'numero2' => 7,
            'resultado' => 42
        ],

        [
            'tipo' => 'División',
            'numero1' => 100,
            'numero2' => 4,
            'resultado' => 25
        ],

        [
            'tipo' => 'Suma',
            'numero1' => 50,
            'numero2' => 30,
            'resultado' => 80
        ]

    ];


    // =====================================================
    // 1. MOSTRAR OPERACIONES ORDENADAS POR RESULTADO
    // =====================================================

    usort($operaciones, function ($a, $b) {
        return $a['resultado'] <=> $b['resultado'];
    });

    echo "<h2>1. Operaciones ordenadas por resultado</h2>";

    echo "<table border='1' cellpadding='8'>";
    echo "<tr>";
    echo "<th>Tipo</th>";
    echo "<th>Número 1</th>";
    echo "<th>Número 2</th>";
    echo "<th>Resultado</th>";
    echo "</tr>";

    foreach ($operaciones as $operacion) {
        echo "<tr>";
        echo "<td>" . $operacion['tipo'] . "</td>";
        echo "<td>" . $operacion['numero1'] . "</td>";
        echo "<td>" . $operacion['numero2'] . "</td>";
        echo "<td>" . $operacion['resultado'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";


    // =====================================================
    // 2. CALCULAR RESULTADO MEDIO
    // =====================================================

    $resultados = array_column($operaciones, 'resultado');

    $sumaResultados = array_sum($resultados);

    $resultadoMedio = $sumaResultados / count($resultados);

    echo "<h2>2. Resultado medio</h2>";
    echo "<p>El resultado medio es: <strong>" . number_format($resultadoMedio, 2) . "</strong></p>";


    // =====================================================
    // 3. OPERACIONES CON RESULTADO SUPERIOR A LA MEDIA
    // =====================================================

    $operacionesSuperiores = array_filter($operaciones, function ($operacion) use ($resultadoMedio) {
        return $operacion['resultado'] > $resultadoMedio;
    });

    echo "<h2>3. Operaciones con resultado superior al resultado medio</h2>";

    echo "<table border='1' cellpadding='8'>";
    echo "<tr>";
    echo "<th>Tipo</th>";
    echo "<th>Número 1</th>";
    echo "<th>Número 2</th>";
    echo "<th>Resultado</th>";
    echo "</tr>";

    foreach ($operacionesSuperiores as $operacion) {
        echo "<tr>";
        echo "<td>" . $operacion['tipo'] . "</td>";
        echo "<td>" . $operacion['numero1'] . "</td>";
        echo "<td>" . $operacion['numero2'] . "</td>";
        echo "<td>" . $operacion['resultado'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";


    // =====================================================
    // 4. CONTAR OPERACIONES POR TIPO
    // =====================================================

    $tipos = array_column($operaciones, 'tipo');

    $contadorTipos = array_count_values($tipos);

    echo "<h2>4. Cantidad de operaciones por tipo</h2>";

    echo "<table border='1' cellpadding='8'>";
    echo "<tr>";
    echo "<th>Tipo</th>";
    echo "<th>Total</th>";
    echo "</tr>";

    foreach ($contadorTipos as $tipo => $total) {
        echo "<tr>";
        echo "<td>" . $tipo . "</td>";
        echo "<td>" . $total . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    ?>

</body>

</html>