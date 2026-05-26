<?php
session_start();

# si no existe el array de pedidos, lo creamos
if (!isset($_SESSION["pedidos"])) {
    $_SESSION["pedidos"] = [];
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    # comprobamos el máximo de 100 entradas
    if (count($_SESSION["pedidos"]) >= 100) {

        $mensaje = "No se pueden registrar más pedidos. Máximo 100.";
    } else {

        $cliente = trim($_POST["cliente"]);
        $producto = trim($_POST["producto"]);
        $cantidad = trim($_POST["cantidad"]);

        # comprobamos que no estén vacíos
        if ($cliente == "" || $producto == "" || $cantidad == "") {

            $mensaje = "Todos los campos son obligatorios.";
        } else {

            # guardamos la entrada en la sesión
            $_SESSION["pedidos"][] = [
                "cliente" => $cliente,
                "producto" => $producto,
                "cantidad" => $cantidad
            ];

            $mensaje = "Pedido registrado correctamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar pedido</title>
</head>

<body>

    <h1>AÑADIR PEDIDO</h1>

    <?php
    if ($mensaje != "") {
        echo "<p>" . htmlspecialchars($mensaje) . "</p>";
    }
    ?>

    <form action="registrar.php" method="POST">

        Cliente
        <input type="text" name="cliente" required>

        Producto
        <input type="text" name="producto" required>

        Cantidad
        <input type="number" name="cantidad" required>

        <input type="submit" value="Añadir pedido">

    </form>

    <br>

    <a href="index.php">Volver al menú</a>

</body>

</html>