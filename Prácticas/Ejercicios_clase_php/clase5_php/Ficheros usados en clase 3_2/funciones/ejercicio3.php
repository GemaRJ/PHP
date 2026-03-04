<?php
function saludo($nombre, $veces)
{
    for ($i = 0; $i < $veces; $i++) {
        print "<p>Hola, $nombre!</p>\n";
        print "\n";
    }
}

saludo("Jose ", 3);
?>