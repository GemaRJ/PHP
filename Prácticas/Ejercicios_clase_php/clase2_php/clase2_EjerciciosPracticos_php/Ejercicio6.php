<?php
/*
6.- Un programa que genere 2 tiradas de 3 dados(simulando 2 jugadores). 
Muestre las dos tiradas y me diga cual tiene mayor puntuación(sumando las tiradas)

*/

$dados_jugador1 = [];
$dados_jugador2 = [];

// Generar las tiradas
for ($i = 0; $i < 3; $i++) {
    $dados_jugador1[] = rand(1, 6);
    $dados_jugador2[] = rand(1, 6);
}

// Calcular sumas
$suma_jugador1 = array_sum($dados_jugador1);
$suma_jugador2 = array_sum($dados_jugador2);

// Mostrar resultados
echo "<h3>Jugador 1</h3>";
foreach ($dados_jugador1 as $dado) {
    echo "<img src='img/$dado.jpg' width='70' alt='Dado $dado'>";
}
echo " <strong> Suma:</strong> $suma_jugador1<br><br>";

echo "<h3>Jugador 2</h3>";
foreach ($dados_jugador2 as $dado) {
    echo "<img src='img/$dado.jpg' width='70' alt='Dado $dado'>";
}
echo " <strong> Suma:</strong> $suma_jugador2<br><br>";

// Mostrar ganador
if ($suma_jugador1 > $suma_jugador2) {
    echo "<h2> El Jugador 1 gana!</h2>";
} elseif ($suma_jugador1 < $suma_jugador2) {
    echo "<h2> El Jugador 2 gana!</h2>";
} else {
    echo "<h2> ¡Empate!</h2>";
}
?>

