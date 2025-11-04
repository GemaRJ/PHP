<head></head>
<body>
<?php
// && (AND) || (OR) ! (NOT)

// Genera un número aleatorio entre 1 y 31 para simular un día del mes
$diaMes = rand(1, 31); 

// Muestra el día aleatorio generado
echo $diaMes . "<br>"; 

// --- Estructuras Condicionales (Tramos del mes) ---

// Bloque 1: Si el día es MENOR que 7 (días 1 a 6)
if ($diaMes < 7) {
    echo 'Estamos a primeros de mes';
}

// Bloque 2: Si el día es MAYOR O IGUAL a 7 Y (&&) MENOR O IGUAL a 23 (días 7 a 23)
if ($diaMes >= 7 && $diaMes <= 23) {
    echo 'Es mediados de mes';
}

// Bloque 3: Si el día es MAYOR que 23 (días 24 a 31)
if ($diaMes > 23) {
    echo 'Es final de mes';
}

?>