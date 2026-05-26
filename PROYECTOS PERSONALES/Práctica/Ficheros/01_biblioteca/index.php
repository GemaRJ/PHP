<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de préstamos</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container my-5">

        <form action="#" method="post">

            <h2>INTRODUCCIÓN DATOS</h2>

            <input type="text" name="DNI" placeholder="Introduce DNI" required class="form-control mb-2">

            <input type="text" name="libro" placeholder="Introduce el libro" required class="form-control mb-2">

            <h5>Introduce fecha de inicio para préstamo</h5>

            <input type="number" name="dia" placeholder="Introduce día" required min="1" max="31"
                class="form-control mb-2">

            <input type="number" name="mes" placeholder="Introduce mes" required min="1" max="12"
                class="form-control mb-2">

            <input type="number" name="year" placeholder="Introduce año" required min="2025" class="form-control mb-2">

            <input type="submit" name="reservar" value="Reservar" class="btn btn-primary">

        </form>

    </div>

    <div class="container mt-3">

        <?php

        $archivoPrestamos = "prestamos.txt";

        abrirArchivo($archivoPrestamos);

        if (isset($_POST["reservar"])) {
            reservarLibro($archivoPrestamos);
        }

        mostrarPrestamos($archivoPrestamos);


        // =====================================================
        // FUNCIÓN PARA CREAR EL ARCHIVO SI NO EXISTE
        // =====================================================

        function abrirArchivo(string $archivo): void
        {
            $fichero = fopen($archivo, "a");
            fclose($fichero);
        }


        // =====================================================
        // FUNCIÓN PARA GUARDAR EL PRÉSTAMO
        // =====================================================

        function reservarLibro(string $archivoPrestamos): void
        {
            $DNI = trim($_POST["DNI"]);
            $libro = trim($_POST["libro"]);
            $dia = trim($_POST["dia"]);
            $mes = trim($_POST["mes"]);
            $year = trim($_POST["year"]);

            if (checkdate((int)$mes, (int)$dia, (int)$year)) {

                $fechaBase = $year . "-" . $mes . "-" . $dia;

                $fechaPrestamo = date("d-m-Y", strtotime($fechaBase));

                $fechaLimite = date("d-m-Y", strtotime($fechaBase . " +7 days"));

                $reserva = $DNI . ":" . $libro . ":" . $fechaPrestamo . ":" . $fechaLimite . PHP_EOL;

                $archivo = fopen($archivoPrestamos, "a");

                fputs($archivo, $reserva);

                fclose($archivo);

                echo "<p class='alert alert-success mt-3'>Préstamo registrado correctamente.</p>";
            } else {

                echo "<p class='alert alert-danger mt-3'>La fecha introducida no es válida.</p>";
            }
        }


        // =====================================================
        // FUNCIÓN PARA MOSTRAR LOS PRÉSTAMOS
        // =====================================================

        function mostrarPrestamos(string $archivoPrestamos): void
        {
            if (file_exists($archivoPrestamos)) {

                $lineas = file($archivoPrestamos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                if (count($lineas) > 0) {

                    echo "<h3 class='mt-4'>Préstamos registrados</h3>";

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
            }
        }

        ?>

    </div>

</body>

</html>