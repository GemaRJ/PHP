<?php
// http://localhost/PHP/01_Variables_php/index01.php

// 01_Variables.php
// VARIABLES Y TIPOS DE DATOS EN PHP
// ========================================

// Explicación general de variables en PHP
// PHP es un lenguaje no tipado estrictamente
// El tipo de dato lo determina el valor que se le asigna

// ========================================
// FORMAS DE DECLARAR VARIABLES
// ========================================

// 1️. Constantes → Constante (NO se puede modificar)
define("NOMBRE_ASIGNATURA", "Desarrollo Cliente");
// Intentar cambiar su valor daría error porque las constantes son inmutables

// 2️. Variables normales (con $) → Se puede modificar
$nombre; // undefined (no tiene valor aún)

if (true) {
    $nombre = "Gema";    // Asignación inicial
    $nombre = "Carlos";  // Reasignación permitida
    echo "$nombre\n";    // Muestra "Carlos"
}

// ========================================
// DIFERENCIAS ENTRE VARIABLES Y CONSTANTES
// ========================================

// Variables normales → permite reasignar
$helloWorld = "¡Hola, PHP!";
echo "$helloWorld\n"; // Muestra: ¡Hola, PHP!

$helloWorld = "¡Hola de nuevo, PHP!";
echo "$helloWorld\n"; // Muestra: ¡Hola de nuevo, PHP!

// Constante → no permite reasignar
define("HELLO_WORLD_CONST", "¡Hola, PHP Constante!");
echo HELLO_WORLD_CONST . "\n"; // Muestra: ¡Hola, PHP Constante!

// ========================================
// TIPOS DE VARIABLES Y EJEMPLOS
// ========================================

$alias = "Enzo";                      // String (cadena de texto)
$edad = 37;                            // Integer
$altura = 1.73;                        // Float
$letraPiso = "A";                      // Char (en PHP no existe char, es string)
$experiencia = true;                   // Boolean (true/false)
$fechaNacimiento = new DateTime("1984-03-21"); // Object (fecha)
$mail = "gema@ue.com";                 // String
$puesto = null;                        // Null (valor intencionadamente vacío)
$conocimiento = null;                  // Simulamos undefined con null

// ========================================
// EJEMPLOS DE SALIDA
// ========================================

// Forma tradicional (concatenación)
echo "Mi nombre es " . $nombre . "\n";
echo "Mi edad es " . $edad . "\n";
echo "Mi puesto es " . $puesto . "\n";
echo "Mi conocimiento es " . $conocimiento . "\n";

// Forma moderna (interpolación de variables con comillas dobles)
echo "Mi nombre es $nombre\n";

// Comprobamos el tipo de cada variable con gettype()
echo "El tipo de la edad es " . gettype($edad) . "\n"; // integer
echo "El tipo de la altura es " . gettype($altura) . "\n"; // double
echo "El tipo del puesto es " . gettype($puesto) . "\n"; // NULL
echo "El tipo del conocimiento es " . gettype($conocimiento) . "\n"; // NULL

// ========================================
// NaN → Not a Number
// ========================================

// Sirve para detectar valores que no son numéricos
$noEsNumero = "abc" / 2; // Resultado: Warning + NaN en PHP
echo "¿El valor noEsNumero es un número válido?: " . (!is_nan($noEsNumero) ? "false" : "true") . "\n";
echo "Valor de noEsNumero: $noEsNumero\n";

// ========================================
// RESUMEN GENERAL
// ========================================

/*
Variables normales → se pueden reasignar
Constantes → no se pueden reasignar ni redeclarar

TIPOS DE DATOS:
- String: texto (entre comillas)
- Integer: número entero
- Float: número decimal
- Boolean: true/false
- Object: objetos, fechas, arrays, etc.
- Null: valor intencionadamente vacío
- NaN: “Not a Number”, indica un resultado no numérico
*/
?>
