<?php 
session_start();

$mensaje = "";

// Si el usuario ya está logueado, redirigir al dashboard
if (isset($_SESSION['logueado']) && $_SESSION['logueado'] === true) {
    header("Location: dashboard.php");
    exit;
}

// Comprobar si se ha enviado el formulario
if (isset($_REQUEST["entrar"])) {

    // Obtener datos del formulario usando $_REQUEST
    $usuario = isset($_REQUEST["usuario"]) ? trim(strip_tags($_REQUEST["usuario"])) : "";
    $clave   = isset($_REQUEST["clave"]) ? trim(strip_tags($_REQUEST["clave"])) : "";

    // Validar datos
    if ($usuario == "" || $clave == "") {
        $mensaje = "Escriba usuario y contraseña.";
    } elseif ($usuario === "admin" && $clave === "1234") {
        // Credenciales correctas
        $_SESSION["usuario"] = $usuario;
        $_SESSION["logueado"] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $mensaje = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>

<body>
    <p style="color:red;"><?php echo $mensaje; ?></p>

    <form action="login.php" method="POST">
        <div>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="clave">Contraseña:</label>
            <input type="password" id="clave" name="clave" required>
        </div>

        <button type="submit" name="entrar">Entrar</button>
    </form>

    <p><a href="index.php">Volver a la página principal</a></p>
</body>

</html>