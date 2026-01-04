<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Conversor de Monedas</title>
</head>

<body>
    <main class="container mt-5">
        <h1 class="mb-4 text-center">Conversor de Monedas</h1>
        <form method="post" class="mx-auto" style="max-width: 400px;">
            <input type="number" step="any" name="cantidad" class="form-control mb-2" placeholder="Cantidad" required>
            <select name="origen" class="form-select mb-2">
                <option value="EUR">Euro (€)</option>
                <option value="USD">Dólar ($)</option>
                <option value="GBP">Libra (£)</option>
                <option value="JPY">Yen (¥)</option>
            </select>
            <select name="destino" class="form-select mb-2">
                <option value="EUR">Euro (€)</option>
                <option value="USD">Dólar ($)</option>
                <option value="GBP">Libra (£)</option>
                <option value="JPY">Yen (¥)</option>
            </select>
            <button type="submit" name="convertir" class="btn btn-primary w-100">Convertir</button>
        </form>
        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cantidad = floatval($_POST["cantidad"]);
        $origen = $_POST["origen"];
        $destino = $_POST["destino"];
        $tasas = ['EUR'=>1, 'USD'=>1.1, 'GBP'=>0.85, 'JPY'=>160];
        $resultado = 0;

        if($cantidad <= 0){
            echo "<div class='alert alert-danger mt-3'>Introduce una cantidad válida.</div>";
        } else {
            $cantidadEUR = $cantidad / $tasas[$origen];
            $resultado = $cantidadEUR * $tasas[$destino];
            echo "<div class='alert alert-success mt-3'>$cantidad $origen = <strong>" . number_format($resultado,2) . " $destino</strong></div>";
        }
    }
    ?>
    </main>
</body>

</html>