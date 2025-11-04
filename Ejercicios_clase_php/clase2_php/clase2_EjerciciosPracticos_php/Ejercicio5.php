<?php
/*
5.- Escribe un programa que muestre en tres columnas: 
Número - Cuadrado - Cubo
De 5 números aleatorios entre 5 y 20.
*/

echo "<table border='1'>
        <tr>
            <th>Número</th>
            <th>Cuadrado</th>
            <th>Cubo</th>
        </tr>";

for ($i = 1; $i <= 5; $i++) {
    $numero = rand(5, 20);
    echo "<tr>";
    echo "<td>$numero</td>";
    echo "<td>" . ($numero ** 2) . "</td>";
    echo "<td>" . ($numero ** 3) . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
