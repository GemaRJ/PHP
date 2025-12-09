<?php


session_start(); 

// eliminar variables
unset($_SESSION["usuario"]);
unset($_SESSION["logueado"]);

// destruir sesión
session_destroy();

// redirigir al inicio
header("Location: index.php");
exit;
?>