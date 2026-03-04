<?php
include 'conexion.php';

// Consulta para obtener todos los productos
$sql = "SELECT * FROM productos ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Productos</title>
</head>
<body>
    <h1>Lista de Productos</h1>
    
    <a href="add.php">Añadir Nuevo</a>
    
    <?php if (mysqli_num_rows($result) > 0): ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Categoría</th>
                <th>Fecha Creación</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td>$<?php echo number_format($row['precio'], 2); ?></td>
                <td><?php echo $row['cantidad']; ?></td>
                <td><?php echo $row['categoria']; ?></td>
                <td><?php echo $row['fecha_creacion']; ?></td>
                <td><?php echo $row['activo'] ? 'Activo' : 'Inactivo'; ?></td>
                <td>
                    <a href="update.php?id=<?php echo $row['id']; ?>">Editar</a> | 
                    <a href="delete.php?id=<?php echo $row['id']; ?>" 
                       onclick="return confirm('¿Borrar este producto?')">Borrar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <p><strong>Total productos:</strong> <?php echo mysqli_num_rows($result); ?></p>
    <?php else: ?>
        <p>No hay productos registrados.</p>
    <?php endif; ?>
    
    <br>
    <a href="indice.php">← Volver al menú</a>
    
    <?php mysqli_close($conn); ?>
</body>
</html>