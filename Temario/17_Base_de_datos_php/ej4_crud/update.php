<?php
include 'conexion.php';

$mensaje = '';
$producto = null;

// Obtener ID desde URL o formulario
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Si se envió el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar'])) {
    $id = intval($_POST['id']);
    
    // Obtener y limpiar datos
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $precio = mysqli_real_escape_string($conn, $_POST['precio']);
    $cantidad = mysqli_real_escape_string($conn, $_POST['cantidad']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $fecha_creacion = mysqli_real_escape_string($conn, $_POST['fecha_creacion']);
    $activo = isset($_POST['activo']) ? 1 : 0;
    
    // Actualizar en base de datos
    $sql = "UPDATE productos SET 
            nombre = '$nombre',
            precio = '$precio',
            cantidad = '$cantidad',
            categoria = '$categoria',
            fecha_creacion = '$fecha_creacion',
            activo = '$activo'
            WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        $mensaje = "Producto actualizado exitosamente.";
    } else {
        $mensaje = "Error: " . mysqli_error($conn);
    }
}

// Obtener datos del producto para editar
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
    <title>Actualizar Producto</title>
</head>
<body>
    <h1>Actualizar Producto</h1>
    
    <!-- Mostrar mensaje -->
    <?php if ($mensaje): ?>
        <p><strong><?php echo $mensaje; ?></strong></p>
    <?php endif; ?>
    
    <?php if ($producto): ?>
        <!-- Formulario de actualización -->
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
            
            <table>
                <tr>
                    <td><label for="nombre">Nombre:</label></td>
                    <td><input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="precio">Precio:</label></td>
                    <td><input type="number" name="precio" step="0.01" value="<?php echo $producto['precio']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="cantidad">Cantidad:</label></td>
                    <td><input type="number" name="cantidad" value="<?php echo $producto['cantidad']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="categoria">Categoría:</label></td>
                    <td>
                        <select name="categoria">
                            <option value="Electrónica" <?php echo $producto['categoria'] == 'Electrónica' ? 'selected' : ''; ?>>Electrónica</option>
                            <option value="Muebles" <?php echo $producto['categoria'] == 'Muebles' ? 'selected' : ''; ?>>Muebles</option>
                            <option value="Libros" <?php echo $producto['categoria'] == 'Libros' ? 'selected' : ''; ?>>Libros</option>
                            <option value="Accesorios" <?php echo $producto['categoria'] == 'Accesorios' ? 'selected' : ''; ?>>Accesorios</option>
                            <option value="Ropa" <?php echo $producto['categoria'] == 'Ropa' ? 'selected' : ''; ?>>Ropa</option>
                            <option value="Otros" <?php echo $producto['categoria'] == 'Otros' ? 'selected' : ''; ?>>Otros</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="fecha_creacion">Fecha Creación:</label></td>
                    <td><input type="date" name="fecha_creacion" value="<?php echo $producto['fecha_creacion']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="activo">Activo:</label></td>
                    <td><input type="checkbox" name="activo" value="1" <?php echo $producto['activo'] ? 'checked' : ''; ?>></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="actualizar" value="Actualizar Producto">
                        <input type="reset" value="Restaurar valores">
                    </td>
                </tr>
            </table>
        </form>
    <?php elseif ($id > 0): ?>
        <p>Producto no encontrado.</p>
    <?php else: ?>
        <p>No se especificó un producto para editar.</p>
        <p>Selecciona un producto desde la <a href="list.php">lista de productos</a>.</p>
    <?php endif; ?>
    
    <br>
    <a href="list.php">← Volver a la lista</a> | 
    <a href="indice.php">Volver al menú</a>
    
    <?php mysqli_close($conn); ?>
</body>
</html>