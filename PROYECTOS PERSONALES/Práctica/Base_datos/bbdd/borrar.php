<?php

require_once __DIR__ . "/configuracion/conexion.php";

$mensaje = "";

# borrar 
if (isset($_POST["borrar"])) {

    $id = (int) $_POST["id"];

    $sql = "DELETE FROM ordenador WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        $mensaje = "Ordenador eliminado.";
    }
}

# mostrar 
$sql2 = "SELECT * FROM ordenador";

$resultados = mysqli_query($conn, $sql2);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Borrar Ordenadores</title>
</head>

<body>

    <h1>Borrar ordenadores</h1>

    <?php echo $mensaje; ?>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acción</th>
        </tr>

        <?php while ($fila = mysqli_fetch_assoc($resultados)) { ?>

            <tr>

                <td>
                    <?php echo $fila["id"]; ?>
                </td>

                <td>
                    <?php echo $fila["nombre"]; ?>
                </td>

                <td>

                    <form method="POST">

                        <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">

                        <button type="submit" name="borrar">
                            Borrar
                        </button>

                    </form>

                </td>

            </tr>

        <?php } ?>

    </table>

    <br>

    <a href="index.php">
        Volver al menú
    </a>

</body>

</html>