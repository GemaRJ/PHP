<?php
// 05_OperadoresAsignacion.php
// ==============================
// OPERADORES DE ASIGNACIÓN EN PHP
// ==============================

// Los operadores de asignación permiten dar o actualizar valores en variables.
// El más básico es el signo igual (=), pero hay combinaciones para operar y asignar al mismo tiempo.

// Ejemplo base
$numero = 10; // Asignamos el valor 10 a la variable "$numero"
echo "Valor inicial: $numero\n";

// ==============================
// ASIGNACIÓN SIMPLE (=)
// ==============================
// El operador "=" asigna un valor a una variable.
$numero = 20; // Reemplaza el valor anterior (10) por 20
echo "Asignación simple: $numero\n";

// ==============================
// SUMA Y ASIGNACIÓN (+=)
// ==============================
// Suma el valor indicado al que ya tiene la variable.
$numero += 5; // Equivale a: $numero = $numero + 5;
echo "Después de += 5: $numero\n"; // 25

// ==============================
// RESTA Y ASIGNACIÓN (-=)
// ==============================
// Resta el valor indicado al que ya tiene la variable.
$numero -= 10; // Equivale a: $numero = $numero - 10;
echo "Después de -= 10: $numero\n"; // 15

// ==============================
// MULTIPLICACIÓN Y ASIGNACIÓN (*=)
// ==============================
// Multiplica el valor actual por el número indicado.
$numero *= 2; // Equivale a: $numero = $numero * 2;
echo "Después de *= 2: $numero\n"; // 30

// ==============================
// DIVISIÓN Y ASIGNACIÓN (/=)
// ==============================
// Divide el valor actual entre el número indicado.
$numero /= 3; // Equivale a: $numero = $numero / 3;
echo "Después de /= 3: $numero\n"; // 10

// ==============================
// MÓDULO Y ASIGNACIÓN (%=)
// ==============================
// Guarda el resto de una división.
$numero %= 4; // Equivale a: $numero = $numero % 4;
echo "Después de %= 4: $numero\n"; // 2 (ya que 10 / 4 deja resto 2)

// ==============================
// EXPONENCIACIÓN Y ASIGNACIÓN (**=)
// ==============================
// Eleva la variable a la potencia indicada.
$numero **= 3; // Equivale a: $numero = $numero ** 3;
echo "Después de **= 3: $numero\n"; // 8

// ==============================
// EJEMPLO PRÁCTICO FINAL
// ==============================
// Simulamos un contador que aumenta con el tiempo

$contador = 0; // Inicializamos
echo "\n=== Ejemplo práctico ===\n";

$contador += 1; // Suma 1
echo "Contador: $contador\n"; // 1

$contador += 1; // Suma otro
echo "Contador: $contador\n"; // 2

$contador *= 2; // Duplicamos el valor
echo "Contador: $contador\n"; // 4

$contador -= 1; // Restamos 1
echo "Contador: $contador\n"; // 3

/*
Resumen operadores de asignación:

=   → Asignación simple
+=  → Suma y asignación
-=  → Resta y asignación
*=  → Multiplicación y asignación
/=  → División y asignación
%=  → Módulo y asignación
**= → Exponenciación y asignación
*/
?>
