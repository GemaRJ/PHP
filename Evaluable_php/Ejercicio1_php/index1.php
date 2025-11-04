<?php

echo "<h1>¡¡¡ Bienvenido a Desarrollo Web en Entorno Servidor !!!</h1>";
echo "<h2>Ejercicio-1: Dibujando un rectángulo de asteriscos</h2>";
echo "<p>Realizar un programa PHP que genere 2 números aleatorios (entre 5 y 15) y dibuje un rectángulo de asteriscos.</p>";

echo "---------------------------------------------------------------------------<br>";
echo "---------------------------------------------------------------------------<br>";

// Generar números aleatorios entre 5 y 15
$alto = rand(5, 15);
$ancho = rand(5, 15);

echo "<h3>Rectángulo generado:</h3>";
echo "Alto: $alto, Ancho: $ancho<br><br>";

// Bucle para dibujar filas
for ($i = 1; $i <= $alto; $i++) {
    // Bucle para dibujar columnas
    for ($j = 1; $j <= $ancho; $j++) {
        echo "*";
    }
    // Salto de línea al final de cada fila
    echo "<br>";
}

?>
