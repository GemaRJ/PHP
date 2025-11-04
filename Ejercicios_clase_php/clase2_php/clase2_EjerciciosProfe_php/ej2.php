<head></head>
<body>
<?php
// Comentarios:
// Variables de tipo int (entero)
$edad = 88; // asignación
$numero = 10;
print "<p>La edad de Pepe es $edad</p>"; // Usamos <p> para un párrafo
print "El numero elegido es $numero<br>"; // Agregamos <br> para salto de línea

// Operadores: + - * / %
$radio = 12;

// Variables de tipo float (flotante)
$perimetro = 2 * 3.14 * $radio;
print "El valor es $perimetro<br>";

// Operador Módulo (%)
$num = 7 % 2; // El resto de 7 entre 2 es 1
print "El resto es $num<br>";

// Variables de Tipo Cadena / Varchar
$cadena1 = "Universidad";
$cadena2 = "Europea";
// El punto (.) concatena las cadenas
$cadena3 = $cadena1 . " " . $cadena2;
print "<p>$cadena3</p>"; // Usamos <p> para otro párrafo

?>