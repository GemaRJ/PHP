<h1>Lista de Productos</h1>

<?php

$conn = mysqli_connect('localhost', 'root', '', 'tienda');

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$sql = "SELECT id, nombre FROM productos";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<ul>';
    while($row = mysqli_fetch_assoc($result)) {
        echo '<li>ID: ' . $row['id'] . ' - Nombre: ' . $row['nombre'] . '</li>';
    }
    echo '</ul>';
} else {
    echo "No hay productos disponibles.";
}

mysqli_close($conn);

?>