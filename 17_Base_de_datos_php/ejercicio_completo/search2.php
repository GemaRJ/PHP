<!DOCTYPE html>
<html>
<head>
    <title>Resultados de la Búsqueda</title>
</head>
<body>
    <h1>Resultados de la Búsqueda</h1>
    <?php
    
        $conn = mysqli_connect('localhost', 'root', 'rootroot', 'tienda');
        if (!$conn) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $sql = "SELECT id, nombre FROM productos WHERE nombre LIKE '%$nombre%'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<ul>';
            while($row = mysqli_fetch_assoc($result)) {
                echo '<li>ID: ' . $row['id'] . ' - Nombre: ' . $row['nombre'] . '</li>';
            }
            echo '</ul>';
        } else {
            echo "No se encontraron productos.";
        }

        mysqli_close($conn);
    
    ?>
    <a href="indice.php">Volver al menú</a>
</body>
</html>