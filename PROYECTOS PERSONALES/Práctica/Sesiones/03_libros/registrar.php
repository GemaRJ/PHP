<?php
session_start();

# si no existe el array de libros, lo creamos
if (!isset($_SESSION["libros"])) {
    $_SESSION["libros"] = [];
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    # comprobamos el máximo de 100 libros
    if (count($_SESSION["libros"]) >= 100) {

        $mensaje = "No se pueden registrar más libros. Máximo 100.";
    } else {

        $titulo = trim($_POST["titulo"]);
        $autor = trim($_POST["autor"]);
        $anio = trim($_POST["anio"]);

        # comprobamos que no estén vacíos
        if ($titulo == "" || $autor == "" || $anio == "") {

            $mensaje = "Todos los campos son obligatorios.";
        } else {

            # guardamos el libro en la sesión
            $_SESSION["libros"][] = [
                "titulo" => $titulo,
                "autor" => $autor,
                "anio" => $anio
            ];

            $mensaje = "Libro registradO correctamente.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar libro</title>
</head>

<body>

    <h1>AÑADIR LIBRO</h1>

    <?php
    if ($mensaje != "") {
        echo "<p>" . htmlspecialchars($mensaje) . "</p>";
    }
    ?>
    <form action="registrar.php" method="POST">

        Título
        <input type="text" name="titulo" required>

        Autor
        <input type="text" name="autor" required>

        Año
        <input type="number" name="anio" required>

        <input type="submit" value="Añadir libro">

    </form>

    <br>

    <a href="index.php">Volver al menú</a>

</body>

</html>