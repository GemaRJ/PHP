<?php

// 04_OperadoresLogicos.php
//http://localhost/PHP/04_Operadores_logicos_php/index04.php
// ==============================
// OPERADORES LÓGICOS EN PHP
// ==============================

// Los operadores lógicos sirven para combinar o negar condiciones.
// Su resultado siempre será un valor booleano: true (verdadero) o false (falso)

// && (AND): Devuelve true solo si TODAS las condiciones son verdaderas
// || (OR): Devuelve true si AL MENOS una condición es verdadera
// !  (NOT): Invierte el valor lógico (true → false, false → true)

// ==============================
// EJEMPLO BASE
// ==============================

// Definimos dos variables de ejemplo
$edad = 25;
$tieneCarnet = true;

// ==============================
// AND (&&)
// ==============================
echo "=== Operador AND (&&) ===\n";

// Ambas condiciones son verdaderas: edad >= 18 es true y tieneCarnet también es true
// Por tanto, el resultado final es true
var_dump($edad >= 18 && $tieneCarnet); // true

// En este caso, la segunda condición es false, así que el resultado total será false
var_dump($edad >= 18 && false); // false

// ==============================
// OR (||)
// ==============================
echo "\n=== Operador OR (||) ===\n";

// Si al menos una de las condiciones es verdadera, el resultado será true
// Aquí ambas son verdaderas, por tanto → true
var_dump($edad >= 18 || $tieneCarnet); // true

// En este caso, ambas condiciones son falsas → resultado false
var_dump(false || false); // false

// ==============================
// NOT (!)
// ==============================
echo "\n=== Operador NOT (!) ===\n";

// NOT invierte el resultado lógico
// $edad >= 18 → true, pero al aplicar ! se convierte en false
$esMenor = !($edad >= 18);
var_dump($esMenor); // false

// ==============================
// COMBINACIÓN DE OPERADORES
// ==============================
echo "\n=== Combinación de operadores ===\n";

// Creamos una variable extra para ver cómo se combinan varios operadores
$tienePermisoPadres = false;

// Aquí la expresión se lee así:
// ($edad >= 18 && $tieneCarnet) → true
// $tienePermisoPadres → false
// Como hay un OR (||) entre ambos, el resultado final es true
$puedeConducir = ($edad >= 18 && $tieneCarnet) || $tienePermisoPadres;

echo "¿Puede conducir? ";
var_dump($puedeConducir); // true

// ==============================
// EJEMPLO PRÁCTICO
// ==============================
echo "\n=== Ejemplo práctico ===\n";

// Creamos variables con una nota y porcentaje de asistencia
$nota = 6;
$asistencia = 85; // porcentaje

// Para aprobar, el alumno necesita tener nota >= 5 Y asistencia >= 80
// Si ambas condiciones se cumplen → true
$aprobado = ($nota >= 5) && ($asistencia >= 80);

// Usamos un if para mostrar el resultado
if ($aprobado) {
    echo "Alumno APROBADO \n";
} else {
    echo "Alumno SUSPENDIDO \n";
}

// ==============================
// OTRO EJEMPLO CON OR (||)
// ==============================
echo "\n=== Ejemplo con OR ===\n";

// Si tiene entrada o es invitado, podrá acceder al evento
$tieneEntrada = false;
$esInvitado = true;

// Como al menos una condición (esInvitado) es true, el resultado será true
if ($tieneEntrada || $esInvitado) {
    echo "Puede acceder al concierto \n";
} else {
    echo "No puede acceder \n";
}

// ==============================
// EJEMPLO CON NOT (!)
// ==============================
echo "\n=== Ejemplo con NOT ===\n";

// Si el usuario NO está conectado (!conectado), se muestra un mensaje de alerta
$conectado = false;

if (!$conectado) {
    echo "Usuario desconectado \n";
} else {
    echo "Usuario en línea \n";
}

/*
Resumen operadores lógicos:

&&  → AND → true solo si todas las condiciones son verdaderas
||  → OR  → true si al menos una condición es verdadera
!   → NOT → invierte el valor lógico
*/
?>
