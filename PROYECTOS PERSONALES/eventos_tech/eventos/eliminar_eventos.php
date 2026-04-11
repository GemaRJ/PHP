<?php
session_start();

// Protegemos la ruta
if (!isset($_SESSION['usuario'])) {
    header("Location: ../autenticacion/login.php");
    exit();
}

require_once "../configuracion/conexion.php";

// Verificamos si nos llega un ID válido por la URL (GET)
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Consulta preparada DELETE para evitar inyección SQL
        $stmt = $conexion->prepare("DELETE FROM eventos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Si borra bien, redirigimos al listado enviando un mensaje por GET
            header("Location: listar_eventos.php?msg=eliminado");
            exit();
        } else {
            echo "Hubo un error al intentar eliminar el evento.";
        }
    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    }
} else {
    // Si entran sin ID, devolvemos al listado
    header("Location: listar_eventos.php");
    exit();
}