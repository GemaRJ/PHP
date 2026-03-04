<?php

$nombre_archivo = "hola.txt";
// Obtener contenido de archivo como cadena
$contenido = file_get_contents($nombre_archivo);
echo "El contenido es: " . $contenido;

?>