<head></head>
<body>
<?php
$numero = 5; //ejemplo de factorial de numero 5
$factorial = 1;
while ( $numero > 1 ) {
    $factorial = $factorial * $numero;
    $numero = $numero - 1;
}
echo ' El factorial de ' . $numero . ' es ' . $factorial . '.';
?>