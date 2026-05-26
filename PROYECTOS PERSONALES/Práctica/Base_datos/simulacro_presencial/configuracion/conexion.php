<?php

$servidor = "localhost";
$usuario = "root";
$password = "";
$baseDatos = "productos";

$conn = mysqli_connect($servidor, $usuario, $password, $baseDatos);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
