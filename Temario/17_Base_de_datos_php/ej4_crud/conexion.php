<?php
// Archivo de conexión a la base de datos
$host = 'localhost';
$usuario = 'root';
$password = 'rootroot';
$base_datos = 'gestion_productos';

// Crear conexión
$conn = mysqli_connect($host, $usuario, $password, $base_datos);

// Verificar conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Opcional: establecer charset
mysqli_set_charset($conn, "utf8");

// NOTA: No cerramos la conexión aquí, se cerrará en cada archivo
?>