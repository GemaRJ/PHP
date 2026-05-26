<?php
session_start();


if (!isset($_SESSION["entradas"])) {
  $_SESSION["entradas"] = [];
}

$mensaje = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


  if (count($_SESSION["entradas"]) >= 100) {

    $mensaje = "No se pueden registrar más entradas.";
  } else {


    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $dia = htmlspecialchars(trim($_POST["dia"]));
    $hora = htmlspecialchars(trim($_POST["hora"]));


    if ($nombre == "" || $dia == "" || $hora == "") {

      $mensaje = "Todos los campos son obligatorios.";
    } else {


      $_SESSION["entradas"][] = [
        "nombre" => $nombre,
        "dia" => $dia,
        "hora" => $hora
      ];

      $mensaje = "Entrada registrada correctamente.";
    }
  }
}


if (isset($_GET["borrar"])) {

  session_destroy();

  session_start();

  $_SESSION["entradas"] = [];

  $mensaje = "Sesión borrada correctamente.";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Cine con sesiones</title>



</head>

<body>

  <h1>GESTIÓN DE ENTRADAS DE CINE</h1>

  <h2>MENÚ INICIAL</h2>

  <ul>

    <li><a href="index.php?reservar=1">Reservar entrada Cine</a></li>

    <li><a href="index.php?ver=1">Ver todas las Entradas</a></li>

    <li><a href="index.php?borrar=1">Borrar Sesión</a></li>

  </ul>

  <hr>

  <?php
  if ($mensaje != "") {
    echo "<p>" . htmlspecialchars($mensaje) . "</p>";
  }
  ?>

  <?php

  if (isset($_GET["reservar"])) {
  ?>

    <h2>RESERVAR ENTRADA</h2>

    <form action="index.php?reservar=1" method="POST">

      Nombre:
      <br>
      <input type="text" name="nombre" required>

      <br><br>

      Día:
      <br>
      <input type="date" name="dia" required>

      <br><br>

      Hora:
      <br>
      <input type="time" name="hora" required>

      <br><br>

      <input type="submit" value="Reservar entrada">

    </form>

  <?php
  }
  ?>

  <?php

  if (isset($_GET["ver"])) {

    echo "<h2>TODAS LAS ENTRADAS</h2>";

    if (count($_SESSION["entradas"]) > 0) {

      echo "<ul>";

      foreach ($_SESSION["entradas"] as $i => $entrada) {

        echo "<li>";

        echo "Entrada " . ($i + 1) . " | ";

        echo "Nombre: " . htmlspecialchars($entrada["nombre"]) . " | ";

        echo "Día: " . htmlspecialchars($entrada["dia"]) . " | ";

        echo "Hora: " . htmlspecialchars($entrada["hora"]);

        echo "</li>";
      }

      echo "</ul>";
    } else {

      echo "<p>No hay entradas registradas.</p>";
    }
  }
  ?>

</body>

</html>