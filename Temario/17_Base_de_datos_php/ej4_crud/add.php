<?php
include 'conexion.php';

// Variable para mensajes
$mensaje = '';

// Procesar formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guardar'])) {
    // Obtener y limpiar datos del formulario
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $precio = mysqli_real_escape_string($conn, $_POST['precio']);
    $cantidad = mysqli_real_escape_string($conn, $_POST['cantidad']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $fecha_creacion = mysqli_real_escape_string($conn, $_POST['fecha_creacion']);
    $activo = isset($_POST['activo']) ? 1 : 0;
    
    // Crear consulta SQL
    $sql = "INSERT INTO productos (nombre, precio, cantidad, categoria, fecha_creacion, activo) 
            VALUES ('$nombre', '$precio', '$cantidad', '$categoria', '$fecha_creacion', '$activo')";
    
    // Ejecutar consulta
    if (mysqli_query($conn, $sql)) {
        $mensaje = "Producto añadido exitosamente. ID: " . mysqli_insert_id($conn);
    } else {
        $mensaje = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Añadir Producto</title>
</head>
<body>
    <h1>Añadir Nuevo Producto</h1>
    
    <!-- Mostrar mensaje si existe -->
    <?php if ($mensaje): ?>
        <p><strong><?php echo $mensaje; ?></strong></p>
    <?php endif; ?>
    
    <!-- Formulario para añadir producto -->
    <form method="post" action="">
        <table>
            <tr>
                <td><label for="nombre">Nombre:</label></td>
                <td><input type="text" name="nombre" required maxlength="100"></td>
            </tr>
            <tr>
                <td><label for="precio">Precio:</label></td>
                <td><input type="number" name="precio" step="0.01" min="0" required></td>
            </tr>
            <tr>
                <td><label for="cantidad">Cantidad:</label></td>
                <td><input type="number" name="cantidad" min="0" required></td>
            </tr>
            <tr>
                <td><label for="categoria">Categoría:</label></td>
                <td>
                    <select name="categoria">
                        <option value="">Seleccione...</option>
                        <option value="Electrónica">Electrónica</option>
                        <option value="Muebles">Muebles</option>
                        <option value="Libros">Libros</option>
                        <option value="Accesorios">Accesorios</option>
                        <option value="Ropa">Ropa</option>
                        <option value="Otros">Otros</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="fecha_creacion">Fecha Creación:</label></td>
                <td><input type="date" name="fecha_creacion" required value="<?php echo date('Y-m-d'); ?>"></td>
            </tr>
            <tr>
                <td><label for="activo">Activo:</label></td>
                <td><input type="checkbox" name="activo" value="1" checked></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="guardar" value="Guardar Producto">
                    <input type="reset" value="Limpiar">
                </td>
            </tr>
        </table>
    </form>
    
    <br>
    <a href="indice.php">Volver al menú</a> | 
    <a href="list.php">Ver todos los productos</a>
    
    <?php mysqli_close($conn); ?>
</body>
</html>