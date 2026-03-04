<?php
// Definición de la función "suma"
// Recibe dos argumentos ($arg1, $arg2)
function suma ($arg1, $arg2)
{
    // La función devuelve el resultado de la suma de los dos argumentos
    return $arg1 + $arg2;
}

// Variables en el ámbito global
$a = 20;
$b = 30;

// Primera forma de usar la función: almacenar el valor retornado en una variable ($suma)
$suma = suma($a, $b);

// Imprime el resultado usando la variable $suma
print "<p>$a + $b = $suma</p>\n";
print "\n";

// Segunda forma de usar la función: llamarla directamente dentro del print
// Esto hace que el valor retornado por la función se concatene en la cadena.
print "<p>$a + $b = " . suma($a, $b) . "</p>\n";
?>