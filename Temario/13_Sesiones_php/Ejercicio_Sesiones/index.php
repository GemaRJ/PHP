<?php
session_start();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio Sesiones</title>
</head>

<body>
    <h1>Bienvenido a la página Principal</h1>
    <?php
    if (isset($_SESSION['logueado']) && $_SESSION['logueado'] === true) {
        $usuario = $_SESSION['usuario']; 
        echo '<p>¡Bienvenido, ' . $usuario . '.</p>';
        echo '<p><a href="dashboard.php">Redirigir al dashboard</a></p>';
        echo '<p><a href="logout.php">Cerrar Sesión</a></p>';
    } else {
        echo '<p>No has iniciado sesión.</p>';
        echo '<p><a href="login.php">Iniciar Sesión</a></p>'; 
    }
    ?>
</body>

</html>