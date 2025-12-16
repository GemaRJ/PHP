<?php
  // Si se envían datos desde el formulario de colores,
  // se actualizan las cookies

  if (isset($_POST["web"])) {
    $web = $_POST["web"];
    $color = $_POST["color"];
    setcookie("web", $web, time() + 3*24*3600);
    setcookie("color", $color, time() + 3*24*3600);
  } else if (isset($_COOKIE["web"])) {
    $web = $_COOKIE["web"];
    $color = $_COOKIE["color"];
  }

  // Borrado de cookies y variables

  if (isset($_POST["borraCookies"])) {
    setcookie("web", NULL, -1);
    setcookie("color", NULL, -1);
    unset($web);
    unset($color);
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>
    <?php
      if (!isset($web)) {
        echo "No has elegido todavía a tus colores favoritos.<br>";
        echo "Utiliza el siguiente formulario para hacerlo.<br>";
      } else {
        echo "<h2>web favorita: ".$web."</h2>";
        echo "<h2>color favorito: ".$color."</h2>";
        echo "Introduce nuevos nombres si quieres cambiar tus preferencias.<br>";
      }
    ?>
    <form action="#" method="post">
      web: <input type="text" name ="web"><br>
      color: <input type="text" name ="color"><br>
      <input type="submit" value="Aceptar">
    </form>
    <hr>

    <form action="#" method="post">
      <input type="hidden" name="borraCookies" value="si">
      <input type="submit" value="Borrar cookies">
    </form>
  </body>
</html>
