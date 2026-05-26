<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Temperaturas</title>
</head>

<body>

    <h1>Registro de Temperaturas</h1>

    <?php

    // Nombre del archivo
    $archivo = "temperaturas.txt";

    // Comprobamos si el archivo existe
    if (file_exists($archivo)) {

        // Leemos todas las líneas del archivo
        $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Variables para cálculos
        $sumaMedias = 0;
        $contador = 0;

        $diaMasCaluroso = "";
        $temperaturaMasAlta = null;

        $diaMasFrio = "";
        $temperaturaMasBaja = null;

        echo "<h2>1. Registros de temperaturas</h2>";

        echo "<table border='1' cellpadding='8'>";
        echo "<tr>";
        echo "<th>Fecha</th>";
        echo "<th>Temperatura mínima</th>";
        echo "<th>Temperatura máxima</th>";
        echo "</tr>";

        // Recorremos cada línea del archivo
        foreach ($lineas as $linea) {

            // Separamos los datos usando |
            $datos = explode("|", $linea);

            $fecha = $datos[0];
            $tempMin = (float)$datos[1];
            $tempMax = (float)$datos[2];

            // Mostramos el registro en la tabla
            echo "<tr>";
            echo "<td>$fecha</td>";
            echo "<td>$tempMin ºC</td>";
            echo "<td>$tempMax ºC</td>";
            echo "</tr>";

            // Calculamos la media diaria
            $mediaDiaria = ($tempMin + $tempMax) / 2;

            // Sumamos las medias diarias
            $sumaMedias += $mediaDiaria;
            $contador++;

            // Comprobamos el día más caluroso
            if ($temperaturaMasAlta === null || $tempMax > $temperaturaMasAlta) {
                $temperaturaMasAlta = $tempMax;
                $diaMasCaluroso = $fecha;
            }

            // Comprobamos el día más frío
            if ($temperaturaMasBaja === null || $tempMin < $temperaturaMasBaja) {
                $temperaturaMasBaja = $tempMin;
                $diaMasFrio = $fecha;
            }
        }

        echo "</table>";

        // 2. Calculamos la temperatura media mensual
        $mediaMensual = $sumaMedias / $contador;

        echo "<h2>2. Temperatura media mensual</h2>";
        echo "<p>La temperatura media mensual es: <strong>" . number_format($mediaMensual, 2) . " ºC</strong></p>";

        // 3. Día más caluroso y más frío
        echo "<h2>3. Día más caluroso y más frío del mes</h2>";
        echo "<p>Día más caluroso: <strong>$diaMasCaluroso</strong> con <strong>$temperaturaMasAlta ºC</strong></p>";
        echo "<p>Día más frío: <strong>$diaMasFrio</strong> con <strong>$temperaturaMasBaja ºC</strong></p>";
    } else {
        echo "<p>No existe el archivo temperaturas.txt</p>";
    }

    ?>

</body>

</html>