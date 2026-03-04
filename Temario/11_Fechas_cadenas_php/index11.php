<?php

// FECHAS Y CADENAS EN PHP


// FECHAS 

// Fecha actual
$fechaActual = new DateTime(); // Objeto DateTime con fecha y hora actual
echo "Fecha actual: " . $fechaActual->format('Y-m-d H:i:s') . "\n";

// Fecha específica: Año, Mes, Día, Hora, Minutos, Segundos
$fechaEspecifica = new DateTime('2025-10-28 12:30:00'); // 28 Octubre 2025 12:30:00
echo "Fecha específica: " . $fechaEspecifica->format('Y-m-d H:i:s') . "\n";

// Obtener componentes de la fecha
echo "Año: " . $fechaActual->format('Y') . "\n";
echo "Mes: " . $fechaActual->format('m') . "\n";
echo "Día del mes: " . $fechaActual->format('d') . "\n";
echo "Día de la semana: " . $fechaActual->format('w') . "\n"; // 0=domingo, 6=sábado
echo "Horas: " . $fechaActual->format('H') . "\n";
echo "Minutos: " . $fechaActual->format('i') . "\n";
echo "Segundos: " . $fechaActual->format('s') . "\n";

// Convertir fecha a string
echo "Formato UTC: " . $fechaActual->format('D, d M Y H:i:s \U\T\C') . "\n";
echo "Formato ISO 8601: " . $fechaActual->format(DateTime::ATOM) . "\n";

// Modificar fecha (ejemplo: cambiar mes a enero)
$fechaActual->setDate($fechaActual->format('Y'), 1, $fechaActual->format('d'));
echo "Mes modificado: " . $fechaActual->format('m') . "\n";

// CADENAS 

$texto = "Hola Mundo";

// Mayúsculas y minúsculas
echo strtoupper($texto) . "\n"; // "HOLA MUNDO"
echo strtolower($texto) . "\n"; // "hola mundo"

// Longitud de la cadena
echo "Longitud: " . strlen($texto) . "\n";

// Caracter en posición específica
echo "Caracter en posición 0: " . $texto[0] . "\n"; // 'H'

// Código ASCII del primer caracter
echo "Código ASCII de 'H': " . ord($texto[0]) . "\n"; // 72

// Concatenar cadenas
$texto2 = " desde PHP";
$textoCompleto = $texto . $texto2 . "!";
echo $textoCompleto . "\n"; // "Hola Mundo desde PHP!"

// Buscar posición de un carácter
$pos = strpos($texto, "M"); // Devuelve índice del primer 'M'
if ($pos !== false) {
    echo "Posición de 'M': " . $pos . "\n";
} else {
    echo "'M' no encontrado\n";
}

// Eliminar espacios al inicio y final
$textoConEspacios = "    Hola mundo    ";
echo "Trim: '" . trim($textoConEspacios) . "'\n";

// Subcadena
echo "Substr(0,4): " . substr($texto, 0, 4) . "\n"; // "Hola"

// Dividir cadena en array
$palabras = explode(" ", "Esto es una prueba");
print_r($palabras); // Array ( [0]=>Esto [1]=>es [2]=>una [3]=>prueba )
echo "Número de palabras: " . count($palabras) . "\n";
?>