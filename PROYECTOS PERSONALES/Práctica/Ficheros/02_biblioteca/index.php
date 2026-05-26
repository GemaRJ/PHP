<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de préstamos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container my-5">

        <h1 class="mb-4">Préstamos de Biblioteca</h1>

        <?php

        // =====================================================
        // ARCHIVO DE PRÉSTAMOS
        // =====================================================

        $archivoPrestamos = "prestamo.txt";

        // =====================================================
        // MOSTRAR PRÉSTAMOS
        // =====================================================

        mostrarPrestamos($archivoPrestamos);


        // =====================================================
        // FUNCIÓN PARA MOSTRAR LOS PRÉSTAMOS
        // =====================================================

        function mostrarPrestamos(string $archivoPrestamos)
        {
            if (file_exists($archivoPrestamos)) {

                $lineas = file($archivoPrestamos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                if (count($lineas) > 0) {

                    echo "<table class='table table-bordered table-striped'>";

                    echo "<tr>";
                    echo "<th>DNI</th>";
                    echo "<th>Título</th>";
                    echo "<th>Fecha préstamo</th>";
                    echo "<th>Fecha límite</th>";
                    echo "</tr>";

                    foreach ($lineas as $linea) {

                        $datos = explode(":", $linea);

                        if (count($datos) == 4) {

                            $dni = $datos[0];
                            $libro = $datos[1];
                            $fechaPrestamo = $datos[2];
                            $fechaLimite = $datos[3];

                            echo "<tr>";

                            echo "<td>" . htmlspecialchars($dni) . "</td>";

                            echo "<td>" . htmlspecialchars($libro) . "</td>";

                            echo "<td>" . htmlspecialchars($fechaPrestamo) . "</td>";

                            echo "<td>" . htmlspecialchars($fechaLimite) . "</td>";

                            echo "</tr>";
                        }
                    }

                    echo "</table>";
                } else {

                    echo "<p>No hay préstamos registrados.</p>";
                }
            } else {

                echo "<p>No existe el archivo prestamos.txt</p>";
            }
        }

        ?>

    </div>

</body>

</html>