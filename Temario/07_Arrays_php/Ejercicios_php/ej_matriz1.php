<?php
$dibujos = [
    "ballena.svg","cebra.svg","elefante.svg","jirafa.svg","oso.svg","pajaro.svg","tigre.svg","tortuga.svg"
];
//$animal = rand(0,7);
echo count($dibujos);
$animal = rand(0, count($dibujos) - 1);

print "  <p><img src=\"img/animales/$dibujos[$animal]\" height=150></p>\n";
?>