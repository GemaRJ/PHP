<head></head>
<body>
<?php
print "<h1>Tirada de dado</h1>\n";

// Genera un número aleatorio entre 1 y 6
$dado = rand(1, 6); 
print "<p>Ha sacado un $dado.</p>\n";

// Condición: Si el dado es igual a 6
if ($dado == 6) {
    print "<p>¡Ha conseguido la máxima puntuación!</p>\n";
} 
// Si la condición NO se cumple (el dado es menor que 6)
else {
    print "<p>¡Menos de 6!</p>\n";
}

print "<p>¡Hasta la próxima!</p>\n";
?>