<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Temperaturas</title>
</head>

<body>

    <h1>Registro de Temperaturas</h1>

    <?php

    $archivo = "temperatura.txt";
    $mensaje = "";



    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $fecha = trim($_POST["fecha"]);
        $tempMin = trim($_POST["tempMin"]);
        $tempMax = trim($_POST["tempMax"]);

        $linea = $fecha . "|" . $tempMin . "|" . $tempMax . PHP_EOL;

        file_put_contents($archivo, $linea, FILE_APPEND);

        $mensaje = "Temperatura guardada correctamente.";
    }

    ?>


    <h2>Añadir temperatura</h2>

    <form method="POST">

        <label>Fecha:</label><br>
        <input type="text" name="fecha" placeholder="dd-mm-yyyy" required><br><br>

        <label>Temperatura mínima:</label><br>
        <input type="number" step="any" name="tempMin" required><br><br>

        <label>Temperatura máxima:</label><br>
        <input type="number" step="any" name="tempMax" required><br><br>

        <button type="submit">Guardar temperatura</button>

    </form>

    <?php

    if ($mensaje != "") {
        echo "<p><strong>$mensaje</strong></p>";
    }

    ?>

    <hr>

    <?php


    if (file_exists($archivo)) {

        $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (count($lineas) > 0) {

            $sumaMedias = 0;
            $contador = 0;

            $diaMasCaluroso = "";
            $temperaturaMasAlta = null;

            $diaMasFrio = "";
            $temperaturaMasBaja = null;

            echo "<h2>Registros de temperaturas</h2>";

            echo "<table border='1' cellpadding='8'>";
            echo "<tr>";
            echo "<th>Fecha</th>";
            echo "<th>Temperatura mínima</th>";
            echo "<th>Temperatura máxima</th>";
            echo "</tr>";

            foreach ($lineas as $linea) {

                $datos = explode("|", $linea);

                $fecha = $datos[0];
                $tempMin = (float)$datos[1];
                $tempMax = (float)$datos[2];

                echo "<tr>";
                echo "<td>$fecha</td>";
                echo "<td>$tempMin ºC</td>";
                echo "<td>$tempMax ºC</td>";
                echo "</tr>";

                $mediaDiaria = ($tempMin + $tempMax) / 2;

                $sumaMedias += $mediaDiaria;
                $contador++;

                if ($temperaturaMasAlta === null || $tempMax > $temperaturaMasAlta) {
                    $temperaturaMasAlta = $tempMax;
                    $diaMasCaluroso = $fecha;
                }

                if ($temperaturaMasBaja === null || $tempMin < $temperaturaMasBaja) {
                    $temperaturaMasBaja = $tempMin;
                    $diaMasFrio = $fecha;
                }
            }

            echo "</table>";

            $mediaMensual = $sumaMedias / $contador;

            echo "<h2>Temperatura media</h2>";
            echo "<p>La temperatura media es: <strong>" . number_format($mediaMensual, 2) . " ºC</strong></p>";

            echo "<h2>Día más caluroso y más frío</h2>";
            echo "<p>Día más caluroso: <strong>$diaMasCaluroso</strong> con <strong>$temperaturaMasAlta ºC</strong></p>";
            echo "<p>Día más frío: <strong>$diaMasFrio</strong> con <strong>$temperaturaMasBaja ºC</strong></p>";
        } else {
            echo "<p>No hay registros de temperaturas.</p>";
        }
    } else {
        echo "<p>Todavía no existe el archivo temperaturas.txt.</p>";
    }

    ?>

</body>

</html>