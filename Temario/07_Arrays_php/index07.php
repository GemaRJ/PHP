<?php

// ==============================
// ARRAYS EN PHP
// ==============================

// Crear arrays
$numeros = [1, 2, 3, 4, 5];
$palabras = ["Hola", "que", "tal"];
$mixto = [1, "hola", true, null];

// Acceso a elementos
echo $numeros[0] . "\n"; // 1
echo $palabras[2] . "\n"; // "tal"

// Modificación de elementos
$numeros[0] = 10;
echo "Array modificado: ";
print_r($numeros);

// Longitud del array
echo "Longitud: " . count($numeros) . "\n";

// Recorrer con for
for ($i = 0; $i < count($numeros); $i++) {
    echo $numeros[$i] . "\n";
}

// Recorrer con foreach
foreach ($palabras as $p) {
    echo $p . "\n";
}

// Métodos comunes
$nombres = ["Borja", "Luis", "Jesús"];
array_push($nombres, "Ana");      // Añadir al final
array_unshift($nombres, "Marta"); // Añadir al inicio
array_pop($nombres);              // Eliminar último
array_shift($nombres);            // Eliminar primero

echo "Array después de modificaciones: ";
print_r($nombres);

// Ordenar y revertir
sort($nombres);   // Orden ascendente
echo "Array ordenado: ";
print_r($nombres);

rsort($nombres);  // Orden descendente
echo "Array invertido: ";
print_r($nombres);

// Concatenar arrays
$array1 = [1, 2];
$array2 = [3, 4];
$combinado = array_merge($array1, $array2);
echo "Arrays concatenados: ";
print_r($combinado);

// Encontrar índice
$idx = array_search("Luis", $nombres);
if ($idx !== false) echo "Luis está en índice: $idx\n";
else echo "Luis no está presente\n";

// Convertir a string
echo "Array a string: " . implode(", ", $nombres) . "\n";

// Splice para eliminar (array_splice)
$arrayEliminar = [1, 2, 3, 4, 5];
array_splice($arrayEliminar, 2, 2); // Elimina 2 elementos desde índice 2
echo "Array tras splice: ";
print_r($arrayEliminar);

?>