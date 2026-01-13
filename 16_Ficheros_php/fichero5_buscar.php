<?php
$numero = $_REQUEST['numero'];
$fichero = "buscar.txt";
$cont = 0;

$fd = fopen($fichero, "r"); // Modo r, read
while(!feof($fd)) { // feof: end of file EOF
    $linea = fgets($fd); //lee del fichero una linea
    //echo $lectura."<br>";
    if (intval($linea) == intval($numero)) {  // intval=> Convierte una cadena en número entero
        $cont++;
    }
}

print "El numero $numero aparece $cont veces en el fichero $fichero\n";

?>