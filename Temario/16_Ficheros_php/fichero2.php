<?php

$nombreArchivo = "clase1.txt";
$mensaje = "HOY ES LUNESSSSSSSSSSSSSSS";

//abrir un fichero
$archivo = fopen($nombreArchivo, "w"); // w - write a-append
echo $archivo;
fputs($archivo, $mensaje); // escribe en el fichero
echo "<br> fichero grabado";
fclose($archivo); // cierra el fichero.

?>