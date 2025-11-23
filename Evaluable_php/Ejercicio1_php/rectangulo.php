<?php

// Generar números aleatorios entre 5 y 15
$alto = rand(5, 15);
$ancho = rand(5, 15);

echo "<h3>Rectángulo Generado:</h3>";
echo "Alto: $alto Ancho: $ancho<br><br>";

// Bucle para dibujar filas
for ($i = 1; $i <= $alto; $i++) {
    for ($j = 1; $j <= $ancho; $j++) {
        echo "*";
    }
    // Salto de línea al final de cada fila
    echo "<br>";
}

?>