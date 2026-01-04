<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Calculadora de IMC</title>
</head>

<body>
    <main class="container mt-4">
        <h1 class="text-center mb-4">Calculadora de IMC</h1>
        <form method="post" class="mx-auto" style="max-width: 400px;">
            <input type="number" step="any" name="peso" class="form-control mb-2" placeholder="Peso (kg)" required>
            <input type="number" step="any" name="altura" class="form-control mb-2" placeholder="Altura (m)" required>
            <button type="submit" name="calcular" class="btn btn-primary w-100">Calcular IMC</button>
        </form>
        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $peso = floatval($_POST["peso"]);
        $altura = floatval($_POST["altura"]);

        if($peso <= 0 || $altura <= 0){
            echo "<div class='alert alert-danger mt-3'>Introduce valores válidos para peso y altura.</div>";
        } else {
            $imc = $peso / ($altura * $altura);
            $categoria = '';
            $color = '';

            if($imc < 18.5){ $categoria='Bajo peso'; $color='alert-primary'; }
            elseif($imc < 25){ $categoria='Normal'; $color='alert-success'; }
            elseif($imc < 30){ $categoria='Sobrepeso'; $color='alert-warning'; }
            else{ $categoria='Obesidad'; $color='alert-danger'; }

            echo "<div class='alert $color mt-3'>IMC: " . number_format($imc,2) . " - Categoria: $categoria</div>";
        }
    }
    ?>
    </main>
</body>

</html>