<?php
session_start();

# si no existe el array de pedidos, lo creamos
if (!isset($_SESSION["pedidos"])) {
    $_SESSION["pedidos"] = [];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de pedidos</title>
</head>

<body>

    <h1>GESTIÓN DE PEDIDOS</h1>

    <h2>MENÚ INICIAL</h2>

    <ul>
        <li><a href="registrar.php">Añadir pedido</a></li>
        <li><a href="index.php?ver=1">Ver todos los pedidos</a></li>
        <li><a href="borrar.php">Borrar sesión</a></li>
    </ul>

    <hr>
    <?php
    if (isset($_GET["ver"])) {

        echo "<h2>TODoS LOS PEDIDOS</h2>";

        if (count($_SESSION["pedidos"]) > 0) {
            echo "<ul>";

            foreach ($_SESSION["pedidos"] as $i => $pedidos) {
                echo "<li>";
                echo "Pedido " . ($i + 1) . " | ";
                echo "Cliente: " . htmlspecialchars($pedidos["cliente"]) . " | ";
                echo "Producto: " . htmlspecialchars($pedidos["producto"]) . " | ";
                echo "Cantidad: " . htmlspecialchars($pedidos["cantidad"]);
                echo "</li>";
            }

            echo "</ul>";
        } else {
            echo "<p>No hay pedidos registrados en la sesión.</p>";
        }
    }
    ?>
</body>

</html>