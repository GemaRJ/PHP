<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <?php
        // Muestra un título en negrita
        echo "<b>Notas:</b><br>";

        // Bucle for que se ejecuta 10 veces (de 0 a 9)
        for ($i = 0; $i < 10; $i++) {
            // Genera un número aleatorio entre 0 y 10 (ambos incluidos)
            // y lo guarda en el array $n en la posición $i
            $n[$i] = rand(0, 10);
        }

        // Recorre el array $n con un bucle foreach
        // En cada iteración, la variable $elemento contiene un valor del array
        foreach ($n as $elemento) {
            // Muestra el número y un salto de línea en HTML
            echo $elemento, "<br>";
        }
    ?>
</body>
</html>
