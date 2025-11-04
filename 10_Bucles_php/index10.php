<?php
// http://localhost/PHP/10_Bucles_php/index10.php
// ==============================
// ESTRUCTURAS DE CONTROL Y BUCLES EN PHP
// ==============================

// ==============================
// IF / ELSE
// ==============================
$nota = 7;

if ($nota < 5) {
    echo "Alumno SUSPENDIDO\n";
} elseif ($nota < 8) {
    echo "Alumno APROBADO con buena nota\n";
} else {
    echo "Alumno APROBADO con excelente nota\n";
}

// ==============================
// IF TERNARIO (operador condicional)
// ==============================
$edad = 20;
$puedeEntrar = ($edad >= 18) ? "Entrada permitida" : "Entrada denegada";
echo $puedeEntrar . "\n";

// ==============================
// SWITCH
// ==============================
$dia = 3;

switch ($dia) {
    case 1:
        echo "Lunes\n";
        break;
    case 2:
        echo "Martes\n";
        break;
    case 3:
        echo "Miércoles\n";
        break;
    case 4:
        echo "Jueves\n";
        break;
    case 5:
        echo "Viernes\n";
        break;
    default:
        echo "Fin de semana\n";
        break;
}

// ==============================
// BUCLE WHILE
// ==============================
$contador = 5;
while ($contador > 0) {
    echo "Contador WHILE: $contador\n";
    $contador--;
}

// ==============================
// BUCLE DO...WHILE
// ==============================
$contadorDo = 3;
do {
    echo "Contador DO...WHILE: $contadorDo\n";
    $contadorDo--;
} while ($contadorDo > 0);

// ==============================
// BUCLE FOR
// ==============================
for ($i = 0; $i < 5; $i++) {
    echo "Contador FOR: $i\n";
}

// ==============================
// BUCLE FOREACH (arrays)
// ==============================
$frutas = ["Manzana", "Plátano", "Cereza"];
foreach ($frutas as $index => $fruta) {
    echo "Fruta $index: $fruta\n";
}

// ==============================
// BUCLE FOR...OF (simulado con foreach)
// ==============================
foreach ($frutas as $fruta) {
    echo "FOR...OF: $fruta\n";
}

// ==============================
// BUCLE FOR...IN (objetos/arrays asociativos)
// ==============================
$persona = [ "nombre" => "Ana", "edad" => 30, "ciudad" => "Madrid" ];
foreach ($persona as $key => $value) {
    echo "$key: $value\n";
}

// ==============================
// MEDICIÓN DE TIEMPO DE EJECUCIÓN
// ==============================
$inicio = microtime(true);
for ($i = 0; $i < 1000000; $i++) {
    // operación pesada simulada
}
$fin = microtime(true);
$tiempo = $fin - $inicio;
echo "Tiempo de ejecución del bucle: $tiempo segundos\n";
?>
