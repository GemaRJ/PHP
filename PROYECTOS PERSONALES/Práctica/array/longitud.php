<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />

    <title>Conversor de Longitud</title>
</head>

<body>

    <main class="container mt-4">

        <h1 class="text-center mb-4">
            Conversor de Longitud
        </h1>

        <form method="POST" class="mx-auto" style="max-width: 400px;">

            <input type="number" step="any" name="valor" class="form-control mb-2" placeholder="Introduce una longitud"
                required>

            <select name="origen" class="form-select mb-2">
                <option value="m">Metros</option>
                <option value="cm">Centímetros</option>
                <option value="km">Kilómetros</option>
                <option value="mi">Millas</option>
            </select>

            <select name="destino" class="form-select mb-2">
                <option value="m">Metros</option>
                <option value="cm">Centímetros</option>
                <option value="km">Kilómetros</option>
                <option value="mi">Millas</option>
            </select>

            <button type="submit" class="btn btn-primary w-100">
                Convertir
            </button>

        </form>

        <?php

        $historial = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $valor = floatval($_POST["valor"]);
            $origen = $_POST["origen"];
            $destino = $_POST["destino"];

            $resultado = 0;
            $valor_m = 0;

            switch ($origen) {
                case "m":
                    $valor_m = $valor;
                    break;

                case "cm":
                    $valor_m = $valor / 100;
                    break;

                case "km":
                    $valor_m = $valor * 1000;
                    break;

                case "mi":
                    $valor_m = $valor * 1609.34;
                    break;
            }

            switch ($destino) {
                case "m":
                    $resultado = $valor_m;
                    break;

                case "cm":
                    $resultado = $valor_m * 100;
                    break;

                case "km":
                    $resultado = $valor_m / 1000;
                    break;

                case "mi":
                    $resultado = $valor_m / 1609.34;
                    break;
            }

            $historial[] = [
                "valor" => $valor,
                "origen" => strtoupper($origen),
                "destino" => strtoupper($destino),
                "resultado" => $resultado
            ];

            echo "
        <div class='alert alert-info mt-3 text-center'>
            <strong>Resultado:</strong>
            " . number_format($resultado, 2) . "
            " . strtoupper($destino) . "
        </div>
        ";

            echo "
        <h3 class='mt-4'>Historial de conversiones</h3>

        <table class='table table-bordered table-striped mt-3'>
            <tr>
                <th>Valor</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Resultado</th>
            </tr>
        ";

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