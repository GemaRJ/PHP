<!-- 
 Crea un script PHP que gestione un array asociativo con operaciones matemáticas realizadas en una calculadora.

Debes:

Mostrar todas las operaciones en una tabla HTML ordenadas por resultado
Calcular y mostrar el resultado medio de todas las operaciones
Mostrar las operaciones cuyo resultado sea superior a la media
Mostrar cuántas operaciones hay de cada tipo (suma, resta, multiplicacion, division) -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Calculadora con Arrays</title>
</head>

<body>

    <h1>Gestión de Operaciones</h1>

    <?php

    // Array asociativo con operaciones
    $operaciones = [
        [
            "tipo" => "suma",
            "numero1" => 5,
            "numero2" => 3,
            "resultado" => 8
        ],
        [
            "tipo" => "resta",
            "numero1" => 10,
            "numero2" => 4,
            "resultado" => 6
        ],
        [
            "tipo" => "multiplicacion",
            "numero1" => 7,
            "numero2" => 5,
            "resultado" => 35
        ],
        [
            "tipo" => "division",
            "numero1" => 20,
            "numero2" => 2,
            "resultado" => 10
        ],
        [
            "tipo" => "suma",
            "numero1" => 15,
            "numero2" => 8,
            "resultado" => 23
        ]
    ];


    // =====================================================
    // 1. Ordenar operaciones por resultado
    // =====================================================

    usort($operaciones, function ($a, $b) {
        return $a["resultado"] <=> $b["resultado"];
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

        echo "<td>" . $operacion["tipo"] . "</td>";
        echo "<td>" . $operacion["numero1"] . "</td>";
        echo "<td>" . $operacion["numero2"] . "</td>";
        echo "<td>" . $operacion["resultado"] . "</td>";

        echo "</tr>";
    }

    echo "</table>";


    // =====================================================
    // 2. Calcular resultado medio
    // =====================================================

    $resultados = array_column($operaciones, "resultado");

    $sumaResultados = array_sum($resultados);

    $media = $sumaResultados / count($resultados);

    echo "<h2>2. Resultado medio</h2>";

    echo "<p>La media es: <strong>" . number_format($media, 2) . "</strong></p>";


    // =====================================================
    // 3. Mostrar operaciones superiores a la media
    // =====================================================

    $superiores = array_filter($operaciones, function ($operacion) use ($media) {

        return $operacion["resultado"] > $media;
    });

    echo "<h2>3. Operaciones superiores a la media</h2>";

    foreach ($superiores as $operacion) {

        echo "<p>";

        echo $operacion["tipo"] . " → ";
        echo $operacion["resultado"];

        echo "</p>";
    }


    // =====================================================
    // 4. Contar operaciones por tipo
    // =====================================================

    $tipos = array_column($operaciones, "tipo");

    $contador = array_count_values($tipos);

    echo "<h2>4. Número de operaciones por tipo</h2>";

    foreach ($contador as $tipo => $cantidad) {

        echo "<p>";

        echo "<strong>" . $tipo . ":</strong> ";
        echo $cantidad . " operación(es)";

        echo "</p>";
    }

    ?>

</body>

</html>