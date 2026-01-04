<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Conversor de Temperatura</title>
</head>

<body>
    <main class="container mt-4">
        <h1 class="text-center mb-4">Conversor de Temperatura</h1>
        <form method="post" class="mx-auto" style="max-width: 400px;">
            <input type="number" step="any" name="valor" class="form-control mb-2" placeholder="Valor" required>
            <select name="origen" class="form-select mb-2">
                <option value="c">Celsius</option>
                <option value="f">Fahrenheit</option>
                <option value="k">Kelvin</option>
            </select>
            <select name="destino" class="form-select mb-2">
                <option value="c">Celsius</option>
                <option value="f">Fahrenheit</option>
                <option value="k">Kelvin</option>
            </select>
            <button type="submit" name="convertir" class="btn btn-primary w-100">Convertir</button>
        </form>
        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valor = floatval($_POST["valor"]);
        $origen = $_POST["origen"];
        $destino = $_POST["destino"];
        $resultado = 0;

        switch($origen){
            case 'c': $valor_c = $valor; break;
            case 'f': $valor_c = ($valor - 32) * 5/9; break;
            case 'k': $valor_c = $valor - 273.15; break;
        }

        switch($destino){
            case 'c': $resultado = $valor_c; break;
            case 'f': $resultado = $valor_c * 9/5 + 32; break;
            case 'k': $resultado = $valor_c + 273.15; break;
        }

        echo "<div class='alert alert-info mt-3'>Resultado: $resultado $destino</div>";
    }
    ?>
    </main>
</body>

</html>