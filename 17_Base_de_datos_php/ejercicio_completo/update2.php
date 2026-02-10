<?php
$conn = mysqli_connect('localhost', 'root', 'rootroot', 'tienda');

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$sql = "SELECT id, nombre FROM productos WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>
    <form method="post" action="update3.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
        
        <input type="submit" value="Actualizar Producto">
    </form>
    <a href="update1.php">Volver a buscar</a> | 
    <a href="indice.php">Volver al menú</a>
</body>
</html>
<?php
} else {
    echo "No se encontró el producto con ID: " . $id . "<br>";
    echo '<a href="update1.php">Intentar de nuevo</a> | ';
    echo '<a href="indice.php">Volver al menú</a>';
}

mysqli_close($conn);
?>