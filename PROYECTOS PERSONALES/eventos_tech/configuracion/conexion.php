<?php

$host = "localhost";
$dbname = "eventos_tech";
$user = "root";
$password = "rootroot";

try {

    $conexion = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password
    );

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    echo "Error de conexión: " . $e->getMessage();
    exit();
}
