<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renting de coches</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container my-5">

        <form action="#" method="post">

            <h2>RENTING DE COCHES</h2>

            <input type="text" name="matricula" placeholder="Introduce matrícula" required class="form-control mb-2">

            <input type="text" name="marca" placeholder="Introduce la marca" required class="form-control mb-2">

            <h5>Introduce fecha de inicio del alquiler</h5>

            <input type="number" name="dia" placeholder="Introduce día" required min="1" max="31"
                class="form-control mb-2">

            <input type="number" name="mes" placeholder="Introduce mes" required min="1" max="12"
                class="form-control mb-2">

            <input type="number" name="anio" placeholder="Introduce año" required min="2025" class="form-control mb-2">

            <input type="submit" name="reservar" value="Reservar" class="btn btn-primary">

        </form>

    </div>

    <div class="container mt-3">

        <?php

        $archivoCoche = "renting.txt";

        abrirArchivo($archivoCoche);

        if (isset($_POST["reservar"])) {
            reservarCoche($archivoCoche);
        }

        mostrarCoche($archivoCoche);


        function abrirArchivo(string $archivo): void
        {
            $fichero = fopen($archivo, "a");
            fclose($fichero);
        }

        function reservarCoche(string $archivoCoche): void
        {
            $matricula = trim($_POST["matricula"]);
            $marca = trim($_POST["marca"]);
            $dia = trim($_POST["dia"]);
            $mes = trim($_POST["mes"]);
            $anio = trim($_POST["anio"]);

            if (checkdate((int)$mes, (int)$dia, (int)$anio)) {

                $fechaBase = $anio . "-" . $mes . "-" . $dia;

                $fechaAlquiler = date("d-m-Y", strtotime($fechaBase));

                $fechaLimite = date("d-m-Y", strtotime($fechaBase . " +30 days"));

                $reserva = $matricula . ":" . $marca . ":" . $fechaAlquiler . ":" . $fechaLimite . PHP_EOL;

                $archivo = fopen($archivoCoche, "a");

                fputs($archivo, $reserva);

                fclose($archivo);

                echo "<p class='alert alert-success mt-3'>Alquiler registrado correctamente.</p>";
            } else {

                echo "<p class='alert alert-danger mt-3'>La fecha introducida no es válida.</p>";
            }
        }

        function mostrarCoche(string $archivoCoche): void
        {
            if (file_exists($archivoCoche)) {

                $lineas = file($archivoCoche, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                if (count($lineas) > 0) {

                    echo "<h3 class='mt-4'>Coches de renting registrados</h3>";

                    echo "<table class='table table-bordered table-striped'>";

                    echo "<tr>";
                    echo "<th>Matrícula</th>";
                    echo "<th>Marca</th>";
                    echo "<th>Fecha alquiler</th>";
                    echo "<th>Fecha límite</th>";
                    echo "</tr>";

                    foreach ($lineas as $linea) {

                        $datos = explode(":", $linea);

                        if (count($datos) == 4) {

                            $matricula = $datos[0];
                            $marca = $datos[1];
                            $fechaAlquiler = $datos[2];
                            $fechaLimite = $datos[3];

                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($matricula) . "</td>";
                            echo "<td>" . htmlspecialchars($marca) . "</td>";
                            echo "<td>" . htmlspecialchars($fechaAlquiler) . "</td>";
                            echo "<td>" . htmlspecialchars($fechaLimite) . "</td>";
                            echo "</tr>";
                        }
                    }

                    echo "</table>";
                } else {

                    echo "<p>No hay coches de alquiler registrados.</p>";
                }
            }
        }

        ?>

    </div>

</body>

</html>