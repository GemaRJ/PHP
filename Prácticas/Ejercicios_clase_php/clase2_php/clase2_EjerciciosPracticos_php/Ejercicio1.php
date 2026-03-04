<?php
//1- Muestra los números múltiplos de 5 de un bucle de 0 a 100 utilizando while.


$i = 0; 

while ($i <= 100) {
    if ($i % 5 == 0) {
        echo $i . "<br>";
    }
    $i++; // Incremento
}


/* CON BUCLE FOR: 

for ($i = 0; $i <= 100; $i++) {
    if ($i % 5 == 0) {
        echo $i . "<br>";
    }
}*/
?>