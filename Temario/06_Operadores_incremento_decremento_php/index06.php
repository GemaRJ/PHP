<?php
// 06_OperadoresIncrementoDecremento.php
// ==============================
// OPERADORES DE INCREMENTO Y DECREMENTO EN PHP
// ==============================

// Estos operadores permiten aumentar o disminuir el valor de una variable en 1.
// Son muy usados en bucles y contadores.

// Ejemplo base
$numero = 5;
echo "Valor inicial: $numero\n";

// ==============================
// INCREMENTO (++)
// ==============================
// Aumenta la variable en 1

$numero++; // Equivale a: $numero = $numero + 1;
echo "Después de numero++: $numero\n"; // 6

++$numero; // Pre-incremento: también suma 1 antes de usar el valor
echo "Después de ++numero: $numero\n"; // 7

// ==============================
// DECREMENTO (--)
// ==============================
// Disminuye la variable en 1

$numero--; // Equivale a: $numero = $numero - 1;
echo "Después de numero--: $numero\n"; // 6

--$numero; // Pre-decremento: también resta 1 antes de usar el valor
echo "Después de --numero: $numero\n"; // 5

// ==============================
// DIFERENCIA ENTRE POSTFIJO Y PREFIJO
// ==============================
// Postfijo ($a++) → devuelve el valor y luego incrementa
// Prefijo (++$b) → incrementa primero y luego devuelve

$a = 10;
echo "\n=== Postfijo ===\n";
echo "a++: $a\n"; // Muestra 10
$a++; // incrementa ahora
echo "Valor actual de a: $a\n"; // 11

$b = 10;
echo "\n=== Prefijo ===\n";
++$b; // primero suma 1
echo "++b: $b\n"; // 11

// ==============================
// EJEMPLO PRÁCTICO: CONTADOR EN BUCLE
// ==============================

echo "\n=== Ejemplo práctico con bucle ===\n";

$contador = 0;

while ($contador < 5) {
  echo "Contador: $contador\n";
  $contador++; // Incrementa en cada iteración
}

// ==============================
// OTRO EJEMPLO: DECREMENTO
// ==============================

$vidas = 3;

while ($vidas > 0) {
  echo "Vidas restantes: $vidas\n";
  $vidas--; // Disminuye en cada iteración
}

echo "¡Juego terminado!\n";

/*
Notas:

- Postfijo (variable++) → devuelve el valor actual y luego incrementa.
- Prefijo (++variable) → incrementa primero y luego devuelve el valor.
- Los operadores de incremento y decremento funcionan igual en PHP y JS.
- Muy útiles en bucles, contadores y para manejar estados.
*/
?>
