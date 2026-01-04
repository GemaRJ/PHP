<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
    <title>Calculadora PHP</title>
    <link rel="stylesheet" href="./utils/style.css" />
</head>

<body>
    <main class="container mt-4">
        <h1 class="text-center mb-4">Calculadora en PHP</h1>
        <form method="post" class="mx-auto" style="max-width: 400px;">
            <div class="mb-3">
                <label for="numero1" class="form-label">Número 1:</label>
                <input type="number" step="any" name="numero1" id="numero1" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="numero2" class="form-label">Número 2:</label>
                <input type="number" step="any" name="numero2" id="numero2" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="operacion" class="form-label">Operación:</label>
                <select name="operacion" id="operacion" class="form-select" required>
                    <option value="sumar">Sumar</option>
                    <option value="restar">Restar</option>
                    <option value="multiplicar">Multiplicar</option>
                    <option value="dividir">Dividir</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Calcular</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numero1 = $_POST["numero1"];
            $numero2 = $_POST["numero2"];
            $operacion = $_POST["operacion"];
            $resultado = "";

            switch ($operacion) {
                case "sumar":
                    $resultado = $numero1 + $numero2;
                    break;
                case "restar":
                    $resultado = $numero1 - $numero2;
                    break;
                case "multiplicar":
                    $resultado = $numero1 * $numero2;
                    break;
                case "dividir":
                    if ($numero2 == 0) {
                        $resultado = "Error: división por cero";
                    } else {
                        $resultado = $numero1 / $numero2;
                    }
                    break;
                default:
                    $resultado = "Operación no válida";
            }

            echo "<div class='alert alert-info text-center mt-3'>Resultado: $resultado</div>";
        }
        ?>
    </main>
    <script src="./index15.js"></script>
</body>

</html>