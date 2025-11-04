<?php
// 03_OperadoresComparacion.php
// ==============================
// OPERADORES DE COMPARACIÓN EN PHP
// ==============================

// Los operadores de comparación se usan para evaluar condiciones
// Devuelven siempre un valor booleano: true (verdadero) o false (falso)

// ===================================================
// === IGUALDAD ESTRICTA (===)
// ===================================================
// Compara valor y tipo de dato. Ambos deben coincidir para devolver true.
$numero = 5;     // integer
$texto = "5";    // string

echo "=== Igualdad estricta ===\n";

// $numero === 5 → true porque valor y tipo son iguales
var_dump($numero === 5); 

// $texto === "5" → true porque valor y tipo son iguales
var_dump($texto === "5"); 

// $numero === $texto → false porque el tipo es distinto (integer vs string)
var_dump($numero === $texto); 

// ===================================================
// == IGUALDAD NO ESTRICTA (==)
// ===================================================
// Compara solo el valor. PHP convierte los tipos si es necesario.
echo "\n== Igualdad no estricta ==\n";

// $numero == $texto → true porque "5" se convierte a número antes de comparar
var_dump($numero == $texto); 

// ===================================================
// !== DIFERENTE ESTRICTO
// ===================================================
// Compara valor y tipo; devuelve true si NO coinciden ambos
echo "\n!== Diferente estricto ==\n";

// $numero !== $texto → true porque el valor es igual pero el tipo es distinto
var_dump($numero !== $texto);

// $numero !== 5 → false porque valor y tipo son iguales
var_dump($numero !== 5); 

// ===================================================
// != DIFERENTE NO ESTRICTO
// ===================================================
// Compara solo el valor, ignora el tipo
echo "\n!= Diferente no estricto ==\n";

// $numero != $texto → false porque el valor es igual
var_dump($numero != $texto); 

// ===================================================
// OPERADORES RELACIONALES: > , < , >= , <=
// ===================================================
$edad = 18;

echo "\n> , < , >= , <=\n";

// Mayor que
var_dump($edad > 18);  // false → 18 no es mayor que 18

// Mayor o igual que
var_dump($edad >= 18); // true → 18 es igual a 18

// Menor que
var_dump($edad < 30);  // true → 18 es menor que 30

// Menor o igual que
var_dump($edad <= 17); // false → 18 no es menor o igual a 17

// ===================================================
// COMPARACIÓN DE CADENAS
// ===================================================
// Las cadenas se comparan alfabéticamente según su valor ASCII/Unicode
echo "\nComparación entre cadenas:\n";

// "a" viene antes que "b" → true
var_dump("a" < "b");  

// "h" viene después de "a" → true
var_dump("hola" > "adiós"); 

// ===================================================
// COMPARACIÓN CON BOOLEANOS
// ===================================================
echo "\nComparación con booleanos:\n";

// true se convierte a 1 al compararse con números → true
var_dump(true == 1);   

// false === 0 → false porque tipos distintos (boolean vs integer)
var_dump(false === 0); 

// false == 0 → true porque PHP convierte false a 0
var_dump(false == 0);  

// ===================================================
// EJEMPLO PRÁCTICO CON CONDICIONAL
// ===================================================
echo "\nEjemplo práctico:\n";

$nota = 7;

// Si la nota es mayor o igual que 5 → aprobado, si no → suspendido
if ($nota >= 5) {
    echo "Has aprobado 😊\n";
} else {
    echo "Has suspendido 😢\n";
}

// ===================================================
// 🔹 Resumen
// ===================================================
/*
Operadores de comparación en PHP:

===  → igualdad estricta (valor y tipo)
==   → igualdad no estricta (solo valor)
!==  → diferente estricto (valor o tipo distinto)
!=   → diferente no estricto (solo valor)
>    → mayor que
<    → menor que
>=   → mayor o igual que
<=   → menor o igual que

Notas:
- var_dump() nos ayuda a ver claramente true/false
- PHP realiza conversiones de tipo implícitas en comparaciones no estrictas
- Las cadenas se comparan alfabéticamente según el orden ASCII/Unicode
- Los booleanos se convierten a enteros (true → 1, false → 0) cuando se comparan con números
*/
?>
