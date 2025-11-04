<?php

echo "<h1>¡¡¡ Bienvenido a Desarrollo Web en Entorno Servidor !!!</h1>";
echo "<h2>Ejercicio-2: Juego de Dados para dos jugadores.</h2>";

echo "<p>El objetivo de este ejercicio es crear un programa en PHP que simule un juego de dados para dos jugadores. 
En lugar de un dado, cada jugador lanzará 5 dados y se almacenarán los resultados en dos vectores (o listas). 
Después de cada tirada, el programa determinará quién gana según las reglas del juego y mostrará el resultado.</p>";

echo "<p><strong>Lanzamiento de Dados:</strong><br>
Cada jugador lanzará 5 dados. Puedes usar la función rand() para simular el lanzamiento de un dado de seis caras (valores entre 1 y 6).
Almacena los resultados de los dos jugadores en dos vectores, uno para cada jugador.</p>";

echo "<p><strong>Determinación del Ganador:</strong><br>
Después de cada tirada, compara los resultados de ambos jugadores.<br>
• Suma los valores obtenidos en los 5 dados de cada jugador.<br>
• El jugador con la suma total más alta gana la ronda.<br>
• Si ambos jugadores tienen la misma suma total, la ronda se considera un empate.<br>
Muestra los resultados después de cada ronda, indicando quién ganó o si hubo un empate.<br>
Lleva un registro de las rondas ganadas por cada jugador a lo largo del juego.</p>";

echo "<p>Utiliza funciones en PHP para estructurar tu código y hacerlo más legible. 
Proporciona una salida clara que indique los resultados de cada ronda y el progreso del juego.</p>";

echo "---------------------------------------------------------------------------<br>";
echo "---------------------------------------------------------------------------<br>";


// Función para lanzar los dados
function lanzarDados($cantidad) {
    $dados = array();
    for ($i = 0; $i < $cantidad; $i++) {
        $dados[] = rand(1, 6);
    }
    return $dados;
}

// Función para mostrar los dados
function mostrarDados($jugador, $dados) {
    echo "<p><strong>$jugador</strong> ha sacado: ";
    
    foreach ($dados as $dado) {
        echo "<img src='dados/$dado.jpg' alt='Dado con valor $dado' width='50' style='margin-right: 5px;'>";
    }
    
    echo "</p>";
}

// Función para sumar los dados
function sumarDados($dados) {
    return array_sum($dados);
}

// Número de rondas
$numeroRondas = 3;
$ganadorJugador1 = 0;
$ganadorJugador2 = 0;

for ($ronda = 1; $ronda <= $numeroRondas; $ronda++) {
    echo "<h3>Ronda $ronda</h3>";

    $dadosJugador1 = lanzarDados(5);
    $dadosJugador2 = lanzarDados(5);

    mostrarDados("Jugador 1", $dadosJugador1);
    mostrarDados("Jugador 2", $dadosJugador2);

    $suma1 = sumarDados($dadosJugador1);
    $suma2 = sumarDados($dadosJugador2);

    echo "<p>Suma Jugador 1: $suma1</p>";
    echo "<p>Suma Jugador 2: $suma2</p>";

    if ($suma1 > $suma2) {
        echo "<p><strong>Jugador 1 gana la ronda!</strong></p>";
        $ganadorJugador1++;
    } elseif ($suma2 > $suma1) {
        echo "<p><strong>Jugador 2 gana la ronda!</strong></p>";
        $ganadorJugador2++;
    } else {
        echo "<p><strong>Empate en esta ronda!</strong></p>";
    }

    echo "<hr>";
}

echo "<h2>Resultados Finales:</h2>";
echo "<p>Rondas ganadas Jugador 1: $ganadorJugador1</p>";
echo "<p>Rondas ganadas Jugador 2: $ganadorJugador2</p>";

if ($ganadorJugador1 > $ganadorJugador2) {
    echo "<h3>¡Jugador 1 es el ganador del juego!</h3>";
} elseif ($ganadorJugador2 > $ganadorJugador1) {
    echo "<h3>¡Jugador 2 es el ganador del juego!</h3>";
} else {
    echo "<h3>El juego terminó en empate.</h3>";
}

?>
