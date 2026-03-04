<?php
// Definición de la función saludo con dos parámetros: $nombre (string) y $veces (integer)
function saludo($nombre, $veces)
{
    // Bucle FOR que se ejecuta desde i=0 hasta que i sea menor que $veces
    for ($i = 0; $i < $veces; $i++) {
        // Imprime el saludo, interpolando el valor de $nombre
        print "<p>Hola, $nombre!</p>\n";
        print "\n"; // Imprime un salto de línea adicional después del párrafo
    }
} // Cierre de la función

// Llamadas a la función
// Llama a la función "saludo" pasando "Jose " como nombre y 3 como número de veces.
saludo("Gema ", 3);
?>