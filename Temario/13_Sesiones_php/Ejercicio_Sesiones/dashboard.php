<?php
session_start();

// Verificar login
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>

    <h1>Área Privada</h1>
    <p>Hola, <?php echo $_SESSION['usuario']; ?>. Este contenido solo es visible para usuarios logueados.</p>

    <a href="index.php">Volver al inicio</a><br>
    <a href="logout.php">Cerrar sesión</a>

</body>

</html>