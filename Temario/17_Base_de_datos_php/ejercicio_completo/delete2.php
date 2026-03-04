<?php
$conn = mysqli_connect('localhost', 'root', 'rootroot', 'tienda');
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $sql = "DELETE FROM productos WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Producto borrado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

mysqli_close($conn);
?>

<a href="indice.php">Volver al menú</a>