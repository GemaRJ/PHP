<!DOCTYPE html>
<html lang="es">
<head>  <meta charset="utf-8"></head>
<body>
  <h1>Resultado</h1>
<?php
$correo  = trim(strip_tags($_REQUEST['correo'])); 
$correo2 = trim(strip_tags($_REQUEST['correo2']));
$recibir = $_REQUEST['recibir'];

$correoOk  = false;
$correo2Ok = false;
$recibirOk = false;

if ($correo == "") {
    print " <p> No ha escrito su dirección de correo.</p>\n";
} elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    print " <p>No ha escrito una dirección de correo correcta.</p>\n";
} else {
    $correoOk = true;
}
if ($correo2 != $correo) {
    print "  <p >Las direcciones de correo no coinciden.</p>\n";
  } else {
    $correo2Ok = true;
}
if ($recibir == "-1") {
    print "  <p>No ha indicado si desea recibir correo.</p>\n";
    
} elseif ($recibir != "0" && $recibir != "1") {
    print "  <p class=\"aviso\">Por favor, indique si quiere recibir o no correo.</p>\n";
    print "\n";
} else {
    $recibirOk = true;
}
if ($correoOk && $correo2Ok && $recibirOk) {
    print "  <p>Su dirección de correo es <strong>$correo</strong>.</p>\n";
    print "\n";
    if ($recibir == "0") {
        print "  <p><strong>No</strong> recibirá correos nuestros.</p>\n";
        print "\n";
    } else {
        print "  <p><strong>Sí</strong> recibirá correos nuestros.</p>\n";
        print "\n";
    }
}
?>
  
</body>
</html>
