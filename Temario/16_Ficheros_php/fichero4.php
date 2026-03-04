<?php

$nombre_archivo = "hola.txt";

// Obtener contenido de archivo como cadena
$contenido = file_get_contents($nombre_archivo);
echo "El contenido es: " . $contenido;

?>

//Lee el contenido de este archivo, lo guarda en la variable y luego lo muestra en la web.