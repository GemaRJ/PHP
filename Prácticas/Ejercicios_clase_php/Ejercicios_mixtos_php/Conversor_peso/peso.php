<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Conversor de Peso</title>
</head>

<body>
    <main class="container mt-4">
        <h1 class="text-center mb-4">Conversor de Peso</h1>

        <form method="post" class="mx-auto" style="max-width: 400px;">
            <input type="number" step="any" name="valor" class="form-control mb-2" placeholder="Valor" required>

            <select name="origen" class="form-select mb-2">
                <option value="kg">Kilogramos</option>
                <option value="lb">Libras</option>
                <option value="oz">Onzas</option>
            </select>

            <select name="destino" class="form-select mb-2">
                <option value="kg">Kilogramos</option>
                <option value="lb">Libras</option>
                <option value="oz">Onzas</option>
            </select>

            <button type="submit" class="btn btn-primary w-100">Convertir</button>
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valor = floatval($_POST["valor"]);
        $origen = $_POST["origen"];
        $destino = $_POST["destino"];
        $resultado = 0;

        switch($origen){
            case "kg": $valor_kg = $valor; break;
            case "lb": $valor_kg = $valor * 0.453592; break;
            case "oz": $valor_kg = $valor * 0.0283495; break;
        }

        switch($destino){
            case "kg": $resultado = $valor_kg; break;
            case "lb": $resultado = $valor_kg / 0.453592; break;
            case "oz": $resultado = $valor_kg / 0.0283495; break;
        }

        echo "<div class='alert alert-info mt-3'>Resultado: $resultado $destino</div>";
    }
    ?>
    </main>
</body>

</html>