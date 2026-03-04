<?
//abro el archivo para lectura
$archivo = fopen ("nombres.txt", "r");
//inicializo una variable para llevar la cuenta de las líneas y los caracteres
$num_lineas = 0;
$caracteres = 0;
//Hago un bucle para recorrer el archivo línea a línea hasta el final del archivo
while (!feof ($archivo)) {
 
	$linea = fgets($archivo);
	echo $linea;
    //$num_lineas++;
    //$caracteres += strlen($linea);
}

fclose ($archivo);
echo "Líneas: " . $num_lineas;
echo "Caracteres: " . $caracteres;
?>