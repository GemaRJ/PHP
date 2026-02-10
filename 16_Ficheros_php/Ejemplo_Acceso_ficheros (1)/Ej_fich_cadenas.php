<?php
/*
Leer archivo de texto con PHP
*/
$nombre_archivo = "equipos.txt";
$fd = fopen($nombre_archivo, "r"); # Modo r, read

while( ($linea=fgets($fd)) !== false ){
 
            // estructura de los datos: codigo_equipo_acb, nombre_equipo, ciudad 
            $arrayDatos =   explode(";", $linea);
			// var_dump($arrayDatos);
            $codigo_equipo_acb  =   $arrayDatos[0];
            $nombre_equipo      =   $arrayDatos[1];   
            $ciudad             =   $arrayDatos[2];   
			echo "Codigo: $codigo_equipo_acb";
			echo "  Nombre: $nombre_equipo ";
			echo "  Ciudad: $ciudad<br>";
}			
 
// No olvides cerrar el fich
fclose($fd);


?>