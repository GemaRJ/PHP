<?php

//4.- Realiza un programa que nos diga cuántos dígitos tiene un número aletorio entre (0 y 9999). Mostrar el número y la cantidad de digitos.

$numero=rand(0,9999); 
$digitos = strlen((string)$numero); 
echo "El número generado es: $numero <br>";
echo "La cantidad de dígitos es: $digitos";

/*
Contar caracteres con strlen():

<?php
$texto = "Hola";
echo strlen($texto);
?>
-----------------------------------------------
Contar contar palabras con str_word_count():

<?php
$texto = "Hola me llamo Gema";
echo str_word_count($texto);
?>
-----------------------------------------------
*/

?>