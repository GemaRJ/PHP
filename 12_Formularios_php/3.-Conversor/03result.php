<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
   
  </head>
  <body>
    <div id="container">
      <div id="header">
        <h2>
          Resultado:
        </h2>
      </div>

      <div id="content">
        <?php
            echo $_POST['euros'], " euros son ", round($_POST['euros'] * 166.386), " pesetas.";
        ?>
      </div>
      
      
    </div>
  </body>
</html>
