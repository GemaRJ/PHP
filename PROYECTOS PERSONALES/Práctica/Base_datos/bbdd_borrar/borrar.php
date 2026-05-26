<?php

require_once __DIR__ . "/configuracion/conexion.php";

if (isset($_GET["id"])) {

    $id = (int) $_GET["id"];

    $sql = "DELETE FROM portatil WHERE id = $id";

    mysqli_query($conn, $sql);
}

mysqli_close($conn);

header("Location: alta.php");
exit;
