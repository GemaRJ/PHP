<?php
// Definición de la función prueba()
function prueba()
{
    // AÑADIR 'global $a;' para traer la variable del ámbito global
    global $a; 
    
    // Ahora, $a SÍ está definida aquí y su valor es 100.
    print "<p>La variable a es $a.</p>\n"; 
    print "\n";
} 

// Damos un valor a la variable $a en el ámbito global
$a = 100;

// Imprimimos el valor de la variable $a (en el ámbito global)
print "<p>La variable a es $a.</p>\n";
print "\n";

// Llamamos a la función
prueba();

// Volvemos a escribir la variable $a (en el ámbito global)
print "<p>La variable a es $a.</p>\n";
?>