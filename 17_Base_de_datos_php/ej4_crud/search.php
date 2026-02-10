<?php
include 'conexion.php';

$resultados = [];
$busqueda = '';

// Procesar búsqueda cuando se envía el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buscar'])) {
    $busqueda = mysqli_real_escape_string($conn, $_POST['busqueda']);
    $criterio = mysqli_real_escape_string($conn, $_POST['criterio']);
    
    // Construir consulta según criterio
    if ($criterio == 'nombre') {
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%$busqueda%' ORDER BY nombre";
    } elseif ($criterio == 'categoria') {
        $sql = "SELECT * FROM productos WHERE categoria LIKE '%$busqueda%' ORDER BY categoria, nombre";
    } elseif ($criterio == 'id') {
        $sql = "SELECT * FROM productos WHERE id = '$busqueda'";
    } else {
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%$busqueda%' OR categoria LIKE '%$busqueda%'";
    }
    
    $result = mysqli_query($conn, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $resultados[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buscar Productos</title>
</head>
<body>
    <h1>Buscar Productos</h1>
    
    <!-- Formulario de búsqueda -->
    <form method="post" action="">
        <table>
            <tr>
                <td><label for="busqueda">Buscar:</label></td>
                <td><input type="text" name="busqueda" value="<?php echo htmlspecialchars($busqueda); ?>" required></td>
            </tr>
            <tr>
                <td><label for="criterio">Buscar por:</label></td>
                <td>
                    <select name="criterio">
                        <option value="nombre">Nombre</option>
                        <option value="categoria">Categoría</option>
                        <option value="id">ID</option>
                        <option value="todos">Todos los campos</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="buscar" value="🔍 Buscar">
                </td>
            </tr>
        </table>
    </form>
    
    <!-- Mostrar resultados -->
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <h2>Resultados de la búsqueda</h2>
        
        <?php if (count($resultados) > 0): ?>
            <p><strong>Encontrados:</strong> <?php echo count($resultados); ?> producto(s)</p>
            <table border="1" cellpadding="8" cellspacing="0">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                </tr>
                <?php foreach ($resultados as $producto): ?>
                <tr>
                    <td><?php echo $producto['id']; ?></td>
                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                    <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td><?php echo $producto['categoria']; ?></td>
                    <td><?php echo $producto['activo'] ? 'Activo' : 'Inactivo'; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No se encontraron productos con esos criterios.</p>
        <?php endif; ?>
    <?php endif; ?>
    
    <br>
    <a href="indice.php">← Volver al menú</a> | 
    <a href="list.php">Ver todos los productos</a>
    
    <?php mysqli_close($conn); ?>
</body>
</html>