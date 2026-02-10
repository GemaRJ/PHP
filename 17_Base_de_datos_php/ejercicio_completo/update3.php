<?php
$conn = mysqli_connect('localhost', 'root', 'rootroot', 'tienda');

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$nombre = mysqli_real_escape_string($conn, $_POST['nombre']);

$sql = "UPDATE productos SET nombre = '$nombre' WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    if (mysqli_affected_rows($conn) > 0) {
        echo "Producto actualizado exitosamente.";
    } else {
        echo "No se realizaron cambios (posiblemente los datos son iguales).";
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

<br>
<a href="update1.php">Actualizar otro producto</a> | 
<a href="indice.php">Volver al menú</a>