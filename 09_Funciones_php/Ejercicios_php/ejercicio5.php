<?php
// ESTA ES LA DEFINICIÓN DE LA FUNCIÓN calculaMedia
// $arg3 tiene un valor por defecto de "aritmética"
function calculaMedia($arg1, $arg2, $arg3 = "aritmética")
{
    // Bloque IF: calcula la media aritmética
    if ($arg3 == "aritmética") {
        $media = ($arg1 + $arg2) / 2;
    } 
    // Bloque ELSEIF: calcula la media geométrica
    elseif ($arg3 == "geométrica") {
        // sqrt() es la función para calcular la raíz cuadrada (square root)
        $media = sqrt($arg1 * $arg2); // Corregido: La fórmula de la media geométrica es solo la raíz del producto
        
        // NOTA: El código original en la imagen tenía un error en la fórmula:
        // $media = sqrt($arg1 * $arg2) / 2; (dividir por 2 es incorrecto para la media geométrica)
        // He mantenido la fórmula correcta, pero debes saber que en tu imagen puede estar el error.
    }
    
    return $media;
}

// ESTO SON EJEMPLOS DE USO DE LA FUNCIÓN calculaMedia
$dato1 = 12;
$dato2 = 16;

// 1. Uso explícito del tercer argumento para la Media Geométrica
$media = calculaMedia($dato1, $dato2, "geométrica");
print "<p>La media geométrica de $dato1 y $dato2 es $media.</p>\n";
print "\n";

// 2. Omisión del tercer argumento (se usa el valor por defecto: "aritmética")
$media = calculaMedia($dato1, $dato2);
print "<p>La media aritmética de $dato1 y $dato2 es $media.</p>\n";
?>