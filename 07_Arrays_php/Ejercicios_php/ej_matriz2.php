<?php
$animales = [
    ["Camello", "camello.svg", "https://es.wikipedia.org/wiki/Camelus"],
    ["Elefante", "elefante.svg", "https://es.wikipedia.org/wiki/Elephantidae"],
    ["Jirafa", "jirafa.svg", "https://es.wikipedia.org/wiki/Giraffa_camelopardalis"],
    ["Oso", "oso.svg", "https://es.wikipedia.org/wiki/Ursidae"],
    ["Pájaro", "pajaro.svg", "https://es.wikipedia.org/wiki/Aves"],
	["tigre", "tigre.svg", "https://es.wikipedia.org/wiki/Panthera_tigris"],
	["Mono", "mono.svg", "https://es.wikipedia.org/wiki/Mono"],
    ["medusa", "medusa.svg", "https://es.wikipedia.org/wiki/Medusozoa"]
];

$animal = rand(0, count($animales) - 1);

print "  <h2>" . $animales[$animal][0] . "</h2>\n";

print "  <p><img src='img/animales/{$animales[$animal][1]}' height=100></p>\n";

print "  <p>Más <a href='{$animales[$animal][2]}'>información sobre este animal</a> en la Wikipedia</p>\n";
?>
