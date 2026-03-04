<?php

$nombre_archivo = "passw.txt";
$fd = fopen($nombre_archivo, "r"); # Modo r, read

while( ($linea=fgets($fd)) !== false ){
 
            // estructura de los datos: /etc/passwd 
            $arrayDatos =   explode(":", $linea);
			// var_dump($arrayDatos);
            $nombre  =   $arrayDatos[0];
            $shell   =   $arrayDatos[6];   
			//echo "$nombre - $shell <br>";
			$shell_2= explode("/", $shell);
			//echo $shell_2[2];
			if (trim($shell_2[2])=="bash")
            {
				echo "$nombre - $shell <br>";
			}
			
}			
 
// No olvides cerrar el fich
fclose($fd);

?>