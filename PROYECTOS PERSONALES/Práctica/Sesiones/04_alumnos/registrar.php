<?php
session_start();

# si no existe el array de entradas, lo creamos
if (!isset($_SESSION["alumnos"])) {
    $_SESSION["alumnos"] = [];
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    # comprobamos el máximo de 100 alumnos
    if (count($_SESSION["alumnos"]) >= 100) {

        $mensaje = "No se pueden registrar más alumnos. Máximo 100.";
    } else {

        $nombre = trim($_POST["nombre"]);
        $curso = trim($_POST["curso"]);
        $nota = trim($_POST["nota"]);

        # comprobamos que no estén vacíos
        if ($nombre == "" || $curso == "" || $nota == "") {

            $mensaje = "Todos los campos son obligatorios.";
        } else {

            # guardamos los alumnos en la sesión
            $_SESSION["alumnos"][] = [
                "nombre" => $nombre,
                "curso" => $curso,
                "nota" => $nota,
            ];

            $mensaje = "Alumno registrado correctamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar alumno</title>
</head>

<body>

    <h1>REGISTRAR ALUMNO</h1>

    <?php
    if ($mensaje != "") {
        echo "<p>" . htmlspecialchars($mensaje) . "</p>";
    }
    ?>


    <form action="registrar.php" method="POST">

        Nombre
        <input type="text" name="nombre" required>

        Curso
        <input type="text" name="curso" required>

        Nota
        <input type="number" name="nota" required>

        <input type="submit" value="Registrar alumno">

    </form>

    <br>

    <a href="index.php">Volver al menú</a>

</body>

</html>