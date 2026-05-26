<!-- 
 Crea un script PHP que funcione como una calculadora web.

Debes:

Crear un formulario donde el usuario introduzca:
número 1
número 2
operación (suma, resta, multiplicacion, division)
Guardar cada operación en un array
Mostrar:
todas las operaciones realizadas
el resultado medio
la operación con resultado más alto -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Calculadora PHP</title>
</head>

<body>

    <h1>Calculadora con Arrays</h1>

    <?php

    // Iniciar sesión
    session_start();

    // Crear array si no existe
    if (!isset($_SESSION["operaciones"])) {
        $_SESSION["operaciones"] = [];
    }


    // =====================================================
    // PROCESAR FORMULARIO
    // =====================================================

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $numero1 = (float) $_POST["numero1"];
        $numero2 = (float) $_POST["numero2"];
        $operacion = $_POST["operacion"];

        $resultado = 0;

        // Realizar operación
        switch ($operacion) {

            case "suma":
                $resultado = $numero1 + $numero2;
                break;

            case "resta":
                $resultado = $numero1 - $numero2;
                break;

            case "multiplicacion":
                $resultado = $numero1 * $numero2;
                break;

            case "division":

                if ($numero2 != 0) {
                    $resultado = $numero1 / $numero2;
                } else {
                    $resultado = "Error";
                }

                break;
        }

        // Guardar operación en sesión
        $_SESSION["operaciones"][] = [
            "numero1" => $numero1,
            "numero2" => $numero2,
            "operacion" => $operacion,
            "resultado" => $resultado
        ];
    }

    ?>



    <!-- ===================================================== -->
    <!-- FORMULARIO -->
    <!-- ===================================================== -->

    <form method="POST">

        <label>Número 1:</label>
        <input type="number" step="any" name="numero1" required>

        <br><br>

        <label>Número 2:</label>
        <input type="number" step="any" name="numero2" required>

        <br><br>

        <label>Operación:</label>

        <select name="operacion">

            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicacion">Multiplicación</option>
            <option value="division">División</option>

        </select>

        <br><br>

        <button type="submit">Calcular</button>

    </form>


    <hr>


    <?php

    // =====================================================
    // MOSTRAR OPERACIONES
    // =====================================================

    echo "<h2>Operaciones realizadas</h2>";

    echo "<table border='1' cellpadding='8'>";

    echo "<tr>";
    echo "<th>Número 1</th>";
    echo "<th>Operación</th>";
    echo "<th>Número 2</th>";
    echo "<th>Resultado</th>";
    echo "</tr>";

    $resultados = [];

    $mayor = null;

    foreach ($_SESSION["operaciones"] as $op) {

        echo "<tr>";

        echo "<td>" . $op["numero1"] . "</td>";
        echo "<td>" . $op["operacion"] . "</td>";
        echo "<td>" . $op["numero2"] . "</td>";
        echo "<td>" . $op["resultado"] . "</td>";

        echo "</tr>";

        // Guardar resultados numéricos
        if (is_numeric($op["resultado"])) {

            $resultados[] = $op["resultado"];

            // Buscar resultado mayor
            if ($mayor === null || $op["resultado"] > $mayor) {
                $mayor = $op["resultado"];
            }
        }
    }

    echo "</table>";


    // =====================================================
    // CALCULAR MEDIA
    // =====================================================

    if (count($resultados) > 0) {

        $media = array_sum($resultados) / count($resultados);

        echo "<h2>Resultado medio</h2>";
        echo "<p>" . number_format($media, 2) . "</p>";

        echo "<h2>Resultado más alto</h2>";
        echo "<p>$mayor</p>";
    }

    ?>

</body>

</html>