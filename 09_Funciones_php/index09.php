<?php
// http://localhost/PHP/09_Funciones_php/index09.php
// ==============================
// FUNCIONES EN PHP
// ==============================

// 1. Función tradicional
function saludar($nombre) {
    return "Hola, $nombre!";
}
echo saludar("Gema") . "\n";

// 2. Función con parámetros por defecto
function sumar($a = 0, $b = 0) {
    return $a + $b;
}
echo "Suma 5 + 3 = " . sumar(5, 3) . "\n";
echo "Suma sin parámetros = " . sumar() . "\n";

// 3. Función anónima asignada a variable
$multiplicar = function($x, $y) {
    return $x * $y;
};
echo "Multiplicación 4 * 6 = " . $multiplicar(4, 6) . "\n";

// 4. Función flecha (arrow function, PHP 7.4+)
$restar = fn($x, $y) => $x - $y;
echo "Resta 10 - 4 = " . $restar(10, 4) . "\n";

// 5. Función que no retorna nada (void)
function mostrarMensaje($msg): void {
    echo "Mensaje: $msg\n";
}
mostrarMensaje("Aprendiendo PHP");

// 6. Función que recibe objeto como parámetro
function mostrarPersona($persona) {
    echo "Nombre: {$persona->nombre}, Edad: {$persona->edad}\n";
}
$persona = new stdClass();
$persona->nombre = "Luis";
$persona->edad = 25;
mostrarPersona($persona);

// 7. Función que recibe array como parámetro
function mostrarNumeros($arr) {
    foreach ($arr as $num) {
        echo "Número: $num\n";
    }
}
$numeros = [1, 2, 3, 4, 5];
mostrarNumeros($numeros);

// 8. Función que llama a otra función
function calcular($a, $b, $operacion) {
    return $operacion($a, $b);
}
echo "Calcular suma: " . calcular(5, 7, 'sumar') . "\n";
echo "Calcular multiplicación: " . calcular(3, 4, $multiplicar) . "\n";

// 9. Función autoejecutable (IIFE en JS)
(function() {
    echo "Esta función se ejecuta sola al definirla\n";
})();

// 10. Función recursiva (factorial)
function factorial($n) {
    if ($n === 0) return 1;
    return $n * factorial($n - 1);
}
echo "Factorial de 5: " . factorial(5) . "\n";

// ==============================
// FUNCIONES ASÍNCRONAS EN PHP
// ==============================
// PHP no tiene async/await como JS, pero podemos simular esperas con sleep() o usar promesas en librerías externas.
// Aquí hacemos un ejemplo simple con sleep:

function obtenerDatos() {
    // Simula retraso de 2 segundos
    sleep(2);
    return (object)[ 'usuario' => 'Gema', 'edad' => 37 ];
}

$datos = obtenerDatos();
echo "Datos recibidos: usuario={$datos->usuario}, edad={$datos->edad}\n";

// Manejo de errores con try/catch
function obtenerDatosConError() {
    try {
        // Simular error
        throw new Exception("Error al obtener datos");
    } catch (Exception $e) {
        echo "Capturado error: " . $e->getMessage() . "\n";
    }
}
obtenerDatosConError();
?>
