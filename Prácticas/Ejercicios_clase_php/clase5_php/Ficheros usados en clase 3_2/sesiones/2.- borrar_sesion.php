<?php
session_start();

$_SESSION["nombre"] = "Samuel Garcia";

print "<p>Su nombre es $_SESSION[nombre].</p>\n";

unset($_SESSION["nombre"]);

if (isset($_SESSION["nombre"])) {
    print "<p>Su nombre es $_SESSION[nombre].</p>\n";
} else {
    print "<p>No sé su nombre.</p>\n";
}
?>