<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <title>Conversor de Unidades</title>
</head>

<body>
    <main class="container mt-4">
        <h1 class="text-center mb-4">Conversor de Unidades con Tabs</h1>

        <!-- NAV TABS -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#longitud">Longitud</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#peso">Peso</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#temperatura">Temperatura</button>
            </li>
        </ul>

        <!-- TAB CONTENT -->
        <div class="tab-content mt-4">

            <!-- LONGITUD -->
            <div class="tab-pane fade show active" id="longitud">
                <form method="post" class="mx-auto" style="max-width: 400px;">
                    <input type="number" step="any" name="valorLongitud" class="form-control mb-2" placeholder="Valor"
                        required>
                    <select name="origenLongitud" class="form-select mb-2">
                        <option value="metros">Metros</option>
                        <option value="kilometros">Kilómetros</option>
                        <option value="millas">Millas</option>
                    </select>
                    <select name="destinoLongitud" class="form-select mb-2">
                        <option value="metros">Metros</option>
                        <option value="kilometros">Kilómetros</option>
                        <option value="millas">Millas</option>
                    </select>
                    <button type="submit" name="convertirLongitud" class="btn btn-primary w-100">Convertir</button>
                </form>
                <?php
            if (isset($_POST['convertirLongitud'])) {
                $valor = floatval($_POST['valorLongitud']);
                $origen = $_POST['origenLongitud'];
                $destino = $_POST['destinoLongitud'];
                $resultado = 0;

                // A metros
                switch($origen){
                    case "metros": $valor_m = $valor; break;
                    case "kilometros": $valor_m = $valor * 1000; break;
                    case "millas": $valor_m = $valor * 1609.34; break;
                }

                // A destino
                switch($destino){
                    case "metros": $resultado = $valor_m; break;
                    case "kilometros": $resultado = $valor_m / 1000; break;
                    case "millas": $resultado = $valor_m / 1609.34; break;
                }

                echo "<div class='alert alert-info mt-3'>Resultado: $resultado $destino</div>";
            }
            ?>
            </div>

            <!-- PESO -->
            <div class="tab-pane fade" id="peso">
                <form method="post" class="mx-auto" style="max-width: 400px;">
                    <input type="number" step="any" name="valorPeso" class="form-control mb-2" placeholder="Valor"
                        required>
                    <select name="origenPeso" class="form-select mb-2">
                        <option value="kg">Kilogramos</option>
                        <option value="lb">Libras</option>
                        <option value="oz">Onzas</option>
                    </select>
                    <select name="destinoPeso" class="form-select mb-2">
                        <option value="kg">Kilogramos</option>
                        <option value="lb">Libras</option>
                        <option value="oz">Onzas</option>
                    </select>
                    <button type="submit" name="convertirPeso" class="btn btn-primary w-100">Convertir</button>
                </form>
                <?php
            if (isset($_POST['convertirPeso'])) {
                $valor = floatval($_POST['valorPeso']);
                $origen = $_POST['origenPeso'];
                $destino = $_POST['destinoPeso'];
                $resultado = 0;

                // A kg
                switch($origen){
                    case "kg": $valor_kg = $valor; break;
                    case "lb": $valor_kg = $valor * 0.453592; break;
                    case "oz": $valor_kg = $valor * 0.0283495; break;
                }

                // A destino
                switch($destino){
                    case "kg": $resultado = $valor_kg; break;
                    case "lb": $resultado = $valor_kg / 0.453592; break;
                    case "oz": $resultado = $valor_kg / 0.0283495; break;
                }

                echo "<div class='alert alert-info mt-3'>Resultado: $resultado $destino</div>";
            }
            ?>
            </div>

            <!-- TEMPERATURA -->
            <div class="tab-pane fade" id="temperatura">
                <form method="post" class="mx-auto" style="max-width: 400px;">
                    <input type="number" step="any" name="valorTemp" class="form-control mb-2" placeholder="Valor"
                        required>
                    <select name="origenTemp" class="form-select mb-2">
                        <option value="c">Celsius</option>
                        <option value="f">Fahrenheit</option>
                        <option value="k">Kelvin</option>
                    </select>
                    <select name="destinoTemp" class="form-select mb-2">
                        <option value="c">Celsius</option>
                        <option value="f">Fahrenheit</option>
                        <option value="k">Kelvin</option>
                    </select>
                    <button type="submit" name="convertirTemp" class="btn btn-primary w-100">Convertir</button>
                </form>
                <?php
            if (isset($_POST['convertirTemp'])) {
                $valor = floatval($_POST['valorTemp']);
                $origen = $_POST['origenTemp'];
                $destino = $_POST['destinoTemp'];
                $resultado = 0;

                // A Celsius
                switch($origen){
                    case "c": $valor_c = $valor; break;
                    case "f": $valor_c = ($valor - 32) * 5/9; break;
                    case "k": $valor_c = $valor - 273.15; break;
                }

                // A destino
                switch($destino){
                    case "c": $resultado = $valor_c; break;
                    case "f": $resultado = $valor_c * 9/5 + 32; break;
                    case "k": $resultado = $valor_c + 273.15; break;
                }

                echo "<div class='alert alert-info mt-3'>Resultado: $resultado $destino</div>";
            }
            ?>
            </div>

        </div>
    </main>
</body>

</html>