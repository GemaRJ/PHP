<?php
$conexion = mysqli_connect("localhost", "root", "", "productos");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$resultados = [];

if (isset($_GET["buscar"])) {
    $buscar = mysqli_real_escape_string($conexion, $_GET["buscar"]);

    $sql = "SELECT * FROM productos 
            WHERE nombre LIKE '%$buscar%'";

    $resultados = mysqli_query($conexion, $sql);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar productos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <h1 class="text-center mb-4">Buscar productos</h1>

        <form method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="buscar" class="form-control" placeholder="Escribe el nombre del producto"
                    value="<?php echo isset($_GET['buscar']) ? $_GET['buscar'] : ''; ?>">

                <button class="btn btn-primary" type="submit">
                    Buscar
                </button>
            </div>
        </form>

        <?php if (isset($_GET["buscar"])) { ?>

            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (mysqli_num_rows($resultados) > 0) { ?>

                        <?php while ($producto = mysqli_fetch_assoc($resultados)) { ?>
                            <tr>
                                <td><?php echo $producto["id"]; ?></td>
                                <td><?php echo $producto["nombre"]; ?></td>
                                <td><?php echo $producto["cantidad"]; ?></td>
                                <td><?php echo $producto["precio"]; ?> €</td>
                            </tr>
                        <?php } ?>

                    <?php } else { ?>

                        <tr>
                            <td colspan="4">No se encontraron productos</td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>

        <?php } ?>

    </div>

</body>

</html>