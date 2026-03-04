<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    
  </head>
  <body>
    <div id="container">
      <div id="header">
          <br>Recogida de datos por teclado
        </h2>
      </div>

      <div id="content">
        <?php
          echo "El área del triángulo es ";
          echo round(($_POST['ancho'] * $_POST['alto']) / 2, $precision = 2), " cm<sup>2</sup>";
        ?>
        
		</div>
    </body>
</html>
