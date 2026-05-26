<?php

$conn = mysqli_connect("localhost", "root", "", "practica_portatiles");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];

    $sql = "DELETE FROM portatil WHERE id = $id";
    mysqli_query($conn, $sql);
}

mysqli_close($conn);

header("Location: alta.php");
exit;
