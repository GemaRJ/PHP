<?php
//Muestra la tabla de multiplicar de un número generado de manera aleatoria entre 1 y 10


$numero = rand(1, 10);

// Crear tabla
echo "<table border='1'>";
echo "<tr>
         <th colspan='2'>Tabla de multiplicar del: $numero</th>
      </tr>";

for ($i = 1; $i <= 10; $i++) {
    $resultado = $numero * $i;
    echo "<tr>";
    echo "<td>$numero x $i</td>";
    echo "<td>$resultado</td>";
    echo "</tr>";
}

echo "</table>";
?>