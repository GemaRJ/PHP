<?php

$nombre = ["", "uno", "dos", "tres", "cuatro", "cinco", "seis"];

$dado = rand(1, 6);
print "  <p><img src='img/$dado.jpg' width='140'></p>\n";
print "  <p>Ha sacado un <strong>$nombre[$dado]</strong>.</p>\n";
?>
