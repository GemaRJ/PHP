<head></head>
<body>
<?php
print "<h1>Tirada de dado</h1>\n";

$dado = rand(1, 6); // Genera un número aleatorio entre 1 y 6
print "<p>Ha sacado un $dado.</p>\n";

if ($dado == 6) {
    print "<p>¡Ha conseguido la máxima puntuación!</p>\n";
} else {
    print "<p>Tienes menos de 6</p>";
}

print "<p>¡Hasta la próxima!</p>\n";
?>