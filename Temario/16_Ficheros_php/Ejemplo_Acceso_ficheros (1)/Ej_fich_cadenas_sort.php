<?php
$nombre_archivo = "equipos.txt";
$fd = fopen($nombre_archivo, "r"); # Modo r, read
$i=0;
while( ($linea=fgets($fd)) !== false ){

            // estructura de los datos: codigo_equipo_acb, nombre_equipo, ciudad 
            $arrayDatos =   explode(";", $linea);
			// var_dump($arrayDatos);
         
            $nombres[$i] = $arrayDatos[1];   
			$i++;
}			
fclose($fd);
echo "<br><br>El número de elementos en el array es: " . count($nombres)."<br>";
sort($nombres); // ordena un array
for($i=0;$i<=count($nombres);$i++)
{
   echo " $nombres[$i] <br>";
}



?>