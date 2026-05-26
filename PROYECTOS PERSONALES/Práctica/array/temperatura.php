<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />

    <title>Conversor de Temperatura</title>
</head>

<body>

    <main class="container mt-4">

        <!-- ===================================================== -->
        <!-- TÍTULO -->
        <!-- ===================================================== -->

        <h1 class="text-center mb-4">
            Conversor de Temperatura
        </h1>

        <!-- ===================================================== -->
        <!-- FORMULARIO -->
        <!-- ===================================================== -->

        <form method="POST" class="mx-auto" style="max-width: 400px;">

            <!-- Temperatura -->
            <input type="number" step="any" name="valor" class="form-control mb-2"
                placeholder="Introduce una temperatura" required>

            <!-- Unidad origen -->
            <select name="origen" class="form-select mb-2">

                <option value="c">Celsius</option>

                <option value="f">Fahrenheit</option>

                <option value="k">Kelvin</option>

            </select>

            <!-- Unidad destino -->
            <select name="destino" class="form-select mb-2">

                <option value="c">Celsius</option>

                <option value="f">Fahrenheit</option>

                <option value="k">Kelvin</option>

            </select>

            <!-- Botón -->
            <button type="submit" name="convertir" class="btn btn-primary w-100">

                Convertir

            </button>

        </form>

        <?php

        // =====================================================
        // ARRAY HISTORIAL
        // =====================================================

        $historial = [];

        // =====================================================
        // PROCESAR FORMULARIO
        // =====================================================

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Obtener datos
            $valor = floatval($_POST["valor"]);

            $origen = $_POST["origen"];

            $destino = $_POST["destino"];

            // Variables
            $resultado = 0;

            $valor_c = 0;

            // =====================================================
            // PASAR A CELSIUS
            // =====================================================

            switch ($origen) {

                case 'c':

                    $valor_c = $valor;

                    break;

                case 'f':

                    $valor_c = ($valor - 32) * 5 / 9;

                    break;

                case 'k':

                    $valor_c = $valor - 273.15;

                    break;
            }

            // =====================================================
            // PASAR DESDE CELSIUS A DESTINO
            // =====================================================

            switch ($destino) {

                case 'c':

                    $resultado = $valor_c;

                    break;

                case 'f':

                    $resultado = ($valor_c * 9 / 5) + 32;

                    break;

                case 'k':

                    $resultado = $valor_c + 273.15;

                    break;
            }

            // =====================================================
            // GUARDAR EN ARRAY
            // =====================================================

            $historial[] = [

                "valor" => $valor,

                "origen" => strtoupper($origen),

                "destino" => strtoupper($destino),

                "resultado" => $resultado
            ];

            // =====================================================
            // MOSTRAR RESULTADO
            // =====================================================

            echo "

            <div class='alert alert-info mt-3 text-center'>

                <strong>Resultado:</strong>

                " . number_format($resultado, 2) . "

                " . strtoupper($destino) . "

            </div>

            ";

            // =====================================================
            // MOSTRAR TABLA
            // =====================================================

            echo "

            <h3 class='mt-4'>
                Historial de conversiones
            </h3>

            <table class='table table-bordered table-striped mt-3'>

                <tr>

                    <th>Valor</th>

                    <th>Origen</th>

                    <th>Destino</th>

                    <th>Resultado</th>

                </tr>

            ";

            // Recorrer historial
            foreach ($historial as $conversion) {

                echo "

                <tr>

                    <td>" . $conversion["valor"] . "</td>

                    <td>" . $conversion["origen"] . "</td>

                    <td>" . $conversion["destino"] . "</td>

                    <td>" . number_format($conversion["resultado"], 2) . "</td>

                </tr>

                ";
            }

            echo "</table>";
        }

        ?>

    </main>

</body>

</html>