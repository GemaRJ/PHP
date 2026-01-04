<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Conversor de Longitud</title>
</head>

<body>
    <main class="container mt-4">
        <h1 class="text-center mb-4">Conversor de Longitud</h1>
        <form method="post" class="mx-auto" style="max-width: 400px;">
            <input type="number" step="any" name="valor" class="form-control mb-2" placeholder="Valor" required>
            <select name="origen" class="form-select mb-2">
                <option value="metros">Metros</option>
                <option value="kilometros">Kilómetros</option>
                <option value="millas">Millas</option>
            </select>
            <select name="destino" class="form-select mb-2">
                <option value="metros">Metros</option>
                <option value="kilometros">Kilómetros</option>
                <option value="millas">Millas</option>
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
            case 'metros': $valor_m = $valor; break;
            case 'kilometros': $valor_m = $valor * 1000; break;
            case 'millas': $valor_m = $valor * 1609.34; break;
        }

        switch($destino){
            case 'metros': $resultado = $valor_m; break;
            case 'kilometros': $resultado = $valor_m / 1000; break;
            case 'millas': $resultado = $valor_m / 1609.34; break;
        }

        echo "<div class='alert alert-info mt-3'>Resultado: $resultado $destino</div>";
    }
    ?>
    </main>
</body>

</html>