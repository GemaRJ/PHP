<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Monedas</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <main class="container mt-5">

        <h1 class="text-center mb-4">
            Conversor de Monedas
        </h1>

        <!-- ===================================================== -->
        <!-- FORMULARIO -->
        <!-- ===================================================== -->

        <form method="POST" class="mx-auto" style="max-width: 400px;">

            <!-- Cantidad -->
            <input type="number" step="any" name="cantidad" class="form-control mb-2" placeholder="Cantidad" required>

            <!-- Moneda origen -->
            <select name="origen" class="form-select mb-2">

                <option value="EUR">Euro (€)</option>
                <option value="USD">Dólar ($)</option>
                <option value="GBP">Libra (£)</option>
                <option value="JPY">Yen (¥)</option>

            </select>

            <!-- Moneda destino -->
            <select name="destino" class="form-select mb-2">

                <option value="EUR">Euro (€)</option>
                <option value="USD">Dólar ($)</option>
                <option value="GBP">Libra (£)</option>
                <option value="JPY">Yen (¥)</option>

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

            $cantidad = floatval($_POST["cantidad"]);

            $origen = $_POST["origen"];

            $destino = $_POST["destino"];

            // Tasas de conversión
            $tasas = [
                "EUR" => 1,
                "USD" => 1.1,
                "GBP" => 0.85,
                "JPY" => 160
            ];

            // Validación
            if ($cantidad <= 0) {

                echo "
            <div class='alert alert-danger mt-3 text-center'>
                Introduce una cantidad válida.
            </div>
            ";
            } else {

                // Pasar primero a euros
                $cantidadEUR = $cantidad / $tasas[$origen];

                // Convertir a moneda destino
                $resultado = $cantidadEUR * $tasas[$destino];

                // Guardar en array
                $historial[] = [

                    "cantidad" => $cantidad,

                    "origen" => $origen,

                    "destino" => $destino,

                    "resultado" => $resultado
                ];

                // =====================================================
                // MOSTRAR RESULTADO
                // =====================================================

                echo "
            <div class='alert alert-success mt-3 text-center'>

                $cantidad $origen = 
                <strong>" . number_format($resultado, 2) . " $destino</strong>

            </div>
            ";

                // =====================================================
                // MOSTRAR TABLA
                // =====================================================

                echo "
            <h3 class='mt-4'>Historial de conversiones</h3>

            <table class='table table-bordered table-striped mt-3'>

                <tr>
                    <th>Cantidad</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Resultado</th>
                </tr>
            ";

                foreach ($historial as $conversion) {

                    echo "
                <tr>

                    <td>" . $conversion["cantidad"] . "</td>

                    <td>" . $conversion["origen"] . "</td>

                    <td>" . $conversion["destino"] . "</td>

                    <td>" . number_format($conversion["resultado"], 2) . "</td>

                </tr>
                ";
                }

                echo "</table>";
            }
        }

        ?>

    </main>

</body>

</html>