<?php 
define("PI", 3.14); // constantes
print "<p>El valor de pi es " . PI . "</p>\n";

$valor = 9;
$valor++; // ++ suma 1   -- resta1
print "<p>" . $valor++. "</p>\n";
print "<p>" . $valor--. "</p>\n";


$numero = 4.3;
$numero1 = round($numero);
print "<p> Round " . $numero1. "</p>\n";
$numero2 = floor($numero);
print "<p> floor " . $numero2. "</p>\n";
$numero3 = ceil($numero);
print "<p> ceil " . $numero3. "</p>\n";
?>