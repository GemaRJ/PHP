<?php
session_start();

session_destroy();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar sesión</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <h1>SESIÓN BORRADA</h1>
    <p>La sesión ha sido eliminada correctamente.</p>

    <a href="index.php">Volver al menú</a>

</body>

</html>