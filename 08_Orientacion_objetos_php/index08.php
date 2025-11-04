<?php
// http://localhost/PHP/08_Orientacion_objetos_php/index08.php
// ==============================
// OBJETOS EN PHP
// ==============================

// Crear un objeto usando stdClass
$persona = new stdClass();
$persona->nombre = "Gema";
$persona->apellido = "Rodríguez";
$persona->edad = 37;
$persona->carnet = true;

// Método para mostrar datos (usando función anónima)
$persona->mostrarDatos = function($obj) {
    echo "Nombre: {$obj->nombre}\n";
    echo "Apellido: {$obj->apellido}\n";
    echo "Edad: {$obj->edad}\n";
    echo "Carnet: " . ($obj->carnet ? "true" : "false") . "\n";
};

// Acceder a propiedades
echo $persona->nombre . "\n";
echo $persona->apellido . "\n";

// Llamar al método (en PHP necesitamos pasar el objeto como parámetro)
$mostrar = $persona->mostrarDatos;
$mostrar($persona);

// Crear propiedad dinámica
$persona->altura = 1.73;
echo "Altura añadida: " . $persona->altura . "\n";

// Eliminar propiedad
unset($persona->carnet);
echo "Después de eliminar carnet: ";
print_r($persona);

// Convertir objeto a array de pares clave-valor
$paresClaveValor = (array) $persona;
echo "Objeto convertido a array:\n";
print_r($paresClaveValor);

// Recorrer array de pares clave-valor
foreach ($paresClaveValor as $clave => $valor) {
    echo "$clave: $valor\n";
}

// Función que retorna un objeto
function crearObjeto($nombre, $apellido) {
    $obj = new stdClass();
    $obj->nombre = $nombre;
    $obj->apellido = $apellido;
    return $obj;
}

$nuevoObjeto = crearObjeto("Luis", "Pérez");
echo "Nuevo objeto creado:\n";
print_r($nuevoObjeto);

// Desestructuración de objetos (simulada con asignación de variables)
function mostrarEquipo($equipo) {
    $nombre = $equipo->nombre;
    $fundacion = $equipo->fundacion;
    $estadio = $equipo->estadio;

    echo "Nombre: $nombre\n";
    echo "Fundación: $fundacion\n";
    echo "Estadio: $estadio\n";
}

$equipo = new stdClass();
$equipo->nombre = "Barcelona";
$equipo->fundacion = 1890;
$equipo->estadio = "Camp Nou";

mostrarEquipo($equipo);

// Nota: En PHP no podemos pasar parámetros normales a una función que espera un objeto
// mostrarEquipo("Barcelona", 1890, "Camp Nou"); // Esto daría error
?>
