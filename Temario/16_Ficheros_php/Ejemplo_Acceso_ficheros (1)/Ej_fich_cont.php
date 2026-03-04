<?php
/*Leer archivo de texto con PHP*/
$nombre_archivo = "nombres.txt";
$num_lineas = 0;
$caracteres = 0;
$fd = fopen($nombre_archivo, "r"); # Modo r, read
while(!feof($fd)){  // feof: end of file EOF
	  $lectura = fgets($fd); //lee del fichero una linea
      //echo $lectura."<br>";
	  $num_lineas++;
	  $caracteres = $caracteres + strlen($lectura);
}

// No olvides cerrar el fich
fclose($fd);
echo "Líneas: " . $num_lineas;
echo "Caracteres: " . $caracteres;
?>