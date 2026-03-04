<?php
$total = 0; // variable acumulador (total)
for ($i = 0; $i < 5; $i++) {
    $dado = rand(1, 6);
   
    print "<img src='./img/$dado.jpg' width=100 height=100>\n";
    $total = $total + $dado;
}
print "<h1>Ha obtenido $total puntos.</h1>\n";
?>