<?php

$hayDos = false; // variable Sw valores: true o false
for ($i = 0; $i < 5; $i++) {
    $dado = rand(1, 6);
    // Línea 5 Modificada:
print "<p>Tirada de dado: <img src='img/$dado.jpg'  width=100 height=100 alt='Dado con valor $dado'></p>";
    if ($dado == 2) {
        $hayDos = true;
    }
} // Fin del bucle

if ($hayDos == true) {
    print "<p>Ha salido al menos un 2.</p>\n";
} else {
    print "<p>No ha salido ningún 2.</p>\n";
}

?>