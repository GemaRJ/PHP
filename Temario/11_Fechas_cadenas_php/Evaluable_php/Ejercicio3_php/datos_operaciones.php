<?php

// RECIBIR LOS DATOS DEL FORMULARIO: También se puede utilizar $_POST o $_GET (Si lo hubieramos utilizado en el index.html)
$num1 = $_REQUEST['numero1'];
$num2 = $_REQUEST['numero2'];
$operacion = $_REQUEST['operacion'];

// Variable para guardar el resultado
switch ($operacion) {
    case 'suma':
        $nombreOperacion = "SUMA";
        $resultado = $num1 + $num2;
        break;

    case 'resta':
        $nombreOperacion = "RESTA";
        $resultado = $num1 - $num2;
        break;

    case 'multiplicacion':
        $nombreOperacion = "MULTIPLICACIÓN";
        $resultado = $num1 * $num2;
        break;

    case 'division':
        $nombreOperacion = "DIVISIÓN";
        if ($num2 == 0) {
            $resultado = "No se puede dividir por cero";
        } else {
            $resultado = $num1 / $num2;
        }
        break;

    default:
        $nombreOperacion = "Operación no válida";
        $resultado = "Operación no válida";
        break;
}

// MOSTRAR EL resultado
echo "<h1>El resultado de la $nombreOperacion entre $num1 y $num2 es: $resultado</h1>";

echo '<br><br><a href="operaciones.html">Realizar otra operación</a>';
?>