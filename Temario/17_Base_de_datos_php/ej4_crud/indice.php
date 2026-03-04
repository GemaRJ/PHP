<?php
include 'conexion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Productos</title>
</head>
<body>
    <h1>Gestión de Productos</h1>
    <ul>
        <li><a href="add.php">Añadir Producto</a></li>
        <li><a href="list.php">Listar Productos</a></li>
        <li><a href="search.php">Buscar Producto</a></li>
        <li><a href="update.php">Actualizar Producto</a></li>
        <li><a href="delete.php">Borrar Producto</a></li>
    </ul>
    
    <h2>Información de la Base de Datos</h2>
    <?php
    // Mostrar información básica de la tabla
    $sql = "SELECT COUNT(*) as total, 
                   SUM(cantidad) as stock_total,
                   AVG(precio) as precio_promedio
            FROM productos WHERE activo = 1";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    
    echo "<p><strong>Total productos activos:</strong> " . $data['total'] . "</p>";
    echo "<p><strong>Stock total:</strong> " . $data['stock_total'] . "</p>";
    echo "<p><strong>Precio promedio:</strong> $" . number_format($data['precio_promedio'], 2) . "</p>";
    
    mysqli_close($conn);
    ?>
</body>
</html>