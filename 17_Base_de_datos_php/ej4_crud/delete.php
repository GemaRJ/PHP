<?php
include 'conexion.php';

$mensaje = '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Confirmar y borrar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmar_borrar'])) {
    $id = intval($_POST['id']);
    
    // Borrar producto
    $sql = "DELETE FROM productos WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn) > 0) {
            $mensaje = "Producto borrado exitosamente.";
        } else {
            $mensaje = "No se encontró el producto para borrar.";
        }
    } else {
        $mensaje = "Error: " . mysqli_error($conn);
    }
}

// Obtener información del producto a borrar
$producto = null;
if ($id > 0) {
    $sql = "SELECT * FROM productos WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $producto = mysqli_fetch_assoc($result);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Borrar Producto</title>
</head>
<body>
    <h1>Borrar Producto</h1>
    
    <!-- Mostrar mensaje -->
    <?php if ($mensaje): ?>
        <p><strong><?php echo $mensaje; ?></strong></p>
        <a href="list.php">Ver lista de productos</a> | 
        <a href="indice.php">Volver al menú</a>
    <?php elseif ($producto): ?>
        <!-- Mostrar confirmación -->
        <p><strong>¿Está seguro de borrar este producto?</strong></p>
        
        <table border="1" cellpadding="8" cellspacing="0">
            <tr><th>Campo</th><th>Valor</th></tr>
            <tr><td>ID</td><td><?php echo $producto['id']; ?></td></tr>
            <tr><td>Nombre</td><td><?php echo htmlspecialchars($producto['nombre']); ?></td></tr>
            <tr><td>Precio</td><td>$<?php echo number_format($producto['precio'], 2); ?></td></tr>
            <tr><td>Cantidad</td><td><?php echo $producto['cantidad']; ?></td></tr>
            <tr><td>Categoría</td><td><?php echo $producto['categoria']; ?></td></tr>
        </table>
        
        <!-- Formulario de confirmación -->
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
            <br>
            <input type="submit" name="confirmar_borrar" value="Sí, borrar producto" 
                   onclick="return confirm('¿ESTÁ ABSOLUTAMENTE SEGURO? Esta acción no se puede deshacer.')">
            <input type="button" value="Cancelar" onclick="window.location.href='list.php'">
        </form>
    <?php else: ?>
        <p>Producto no encontrado o ID no especificado.</p>
        <a href="list.php">Ver lista de productos</a> | 
        <a href="indice.php">Volver al menú</a>
    <?php endif; ?>
    
    <?php mysqli_close($conn); ?>
</body>
</html>