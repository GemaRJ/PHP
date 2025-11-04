<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>

    <?php
    // RECIBIR LOS DATOS DEL FORMULARIO
    $num1 = $_POST['numero1'];
    $num2 = $_POST['numero2'];
    $operacion = $_POST['operacion']; 

    // Variable para guardar el resultado
    $resultado = 0; 

    switch ($operacion) {
        case 'suma':
            $resultado = $num1 + $num2; 
            break; 

        case 'resta':
            $resultado = $num1 - $num2; 
            break; 

        case 'multiplicacion':
            $resultado = $num1 * $num2; 
            break; 

        case 'division':
            if ($num2 == 0) {
                $resultado = "Error: No se puede dividir por cero";
            } else {
                $resultado = $num1 / $num2; 
            }
            break; 

        default:
            $resultado = "Operación desconocida";
            break;
    }

    // MOSTRAR RESULTADO
    echo "<h1>El resultado es: $resultado</h1>";
    ?>

    <br><br>
    <a href="operaciones.php">Realizar otra operación</a>

</body>
</html>
