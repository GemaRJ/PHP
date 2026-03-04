<?php
session_start();

$_SESSION["nombre"] = "Pepito Conejo";
session_destroy();

if (isset($_SESSION["nombre"])) {
    print "<p>Su nombre es $_SESSION[nombre].</p>\n";
} else {
    print "<p>No sé su nombre.</p>\n";
}
?>