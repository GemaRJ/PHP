<?php

// http://localhost/PHP/02_Operadores_php/index02.php


// Ejemplos de operadores aritméticos y de asignación
// ===================================================

// Operador de Asignación (=)
$a = 1;
$b = 2;
$a = $b; // Asigna el valor de b a a
echo "(=) El valor de a es $a\n"; // Resultado: 2

// Operador de Suma y Asignación (+=)
$suma = 5;
$incremento = 3;
$suma += $incremento; // igual que suma = suma + incremento
echo "(+=) El valor de suma es $suma\n"; // Resultado: 8

// Operador de Resta (-)
$num1 = 10;
$num2 = 4;
$resta = $num1 - $num2;
echo "(-) El resultado de la resta es $resta\n"; // Resultado: 6

// Operadores de Incremento (++) y Decremento (--)
$contador = 5;
$contador++; // incrementa en 1
$contador++; // incrementa en 1 otra vez
echo "(++) Valor tras incrementar dos veces: $contador\n"; // 7

$contador--; // decrementa en 1
echo "(--) Valor tras decrementar una vez: $contador\n"; // 6

// Operador de Multiplicación (*)
$ancho = 4;
$alto = 3;
$area = $ancho * $alto;
echo "(*) El área del rectángulo es $area\n"; // 12

// Operador de División (/)
$dividendo = 10;
$divisor = 2;
$division = $dividendo / $divisor;
echo "(/) El resultado de dividir $dividendo entre $divisor es $division\n"; // 5

// Operador de Módulo (%)
$numero = 10;
$divisor2 = 3;
$resto = $numero % $divisor2;
echo "(%) El resto de dividir $numero entre $divisor2 es $resto\n"; // 1

// ===================================================
// Ejemplo combinado
// ===================================================
$x = 5;
$y = 2;

echo "\n--- Ejemplo combinado ---\n";
echo "x = $x, y = $y\n";
echo "x + y = " . ($x + $y) . "\n"; // Suma
echo "x - y = " . ($x - $y) . "\n"; // Resta
echo "x * y = " . ($x * $y) . "\n"; // Multiplicación
echo "x / y = " . ($x / $y) . "\n"; // División
echo "x % y = " . ($x % $y) . "\n"; // Módulo
echo "++x = " . (++$x) . "\n";     // Incremento previo
echo "--y = " . (--$y) . "\n";     // Decremento previo

// ===================================================
// 🔹 Notas finales
// ===================================================
/*
Resumen de operadores aritméticos:

=   → Asignación
+=  → Suma y asignación
-=  → Resta y asignación
*   → Multiplicación
/   → División
%   → Módulo (resto)
++  → Incremento
--  → Decremento

Consejo:
- Usa const si el valor no cambia (define("CONSTANTE", valor)).
- Usa variables normales ($var) si el valor puede cambiar.
*/
?>
