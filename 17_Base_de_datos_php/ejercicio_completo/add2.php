<?php
$conn = mysqli_connect('localhost', 'root', 'rootroot', 'tienda');
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
  // control de errores
    $nombre = mysqli_real_escape_string($conn, $_REQUEST['nombre']);
    $sql = "INSERT INTO productos (nombre) VALUES ('$nombre')";

    if (mysqli_query($conn, $sql)) {
        echo "Producto añadido exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


mysqli_close($conn);
?>

<a href="indice.php">Volver al menú</a>