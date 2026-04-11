<?php

session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location: /eventos_tech/autenticacion/login.php");
    exit();
}
