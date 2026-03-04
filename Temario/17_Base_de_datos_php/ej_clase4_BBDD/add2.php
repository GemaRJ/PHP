<?php
$conn = mysqli_connect('localhost', 'root', 'rootroot', 'tienda');

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $sql = "INSERT INTO productos (nombre) VALUES ('$nombre')";

    if (mysqli_query($conn, $sql)) {
        echo "Producto añadido exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


mysqli_close($conn);
?>

<a href="indice.php">Volver al menú</a>