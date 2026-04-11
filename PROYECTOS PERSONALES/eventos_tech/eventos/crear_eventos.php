<?php
session_start();

// Protegemos la ruta: si no hay sesión, de vuelta al login
if (!isset($_SESSION['usuario'])) {
    header("Location: ../autenticacion/login.php");
    exit();
}

// Requerimos la conexión a la base de datos PDO
require_once "../configuracion/conexion.php";

$mensaje = "";
$error_db = "";

// Si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guardar_evento'])) {
    // Limpiamos y validamos las entradas del usuario para evitar XSS y otros ataques
    $nombre = trim($_POST['nombre']);
    $fecha = trim($_POST['fecha']);
    $lugar = trim($_POST['lugar']);
    $capacidad = trim($_POST['capacidad']);
    $descripcion = trim($_POST['descripcion']);

    if (empty($nombre) || empty($fecha)) {
        $error_db = "Los campos Nombre y Fecha son obligatorios.";
    } else {
        try {
            // Consulta "Preparada" para evitar inyección SQL. Lo que recomendaste en clase aplicarlo aquí, lo hice.
            $sql = "INSERT INTO eventos (nombre, fecha, descripcion, lugar, capacidad) 
                    VALUES (:nombre, :fecha, :descripcion, :lugar, :capacidad)";

            $stmt = $conexion->prepare($sql);

            // Vinculamos los parámetros
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':lugar', $lugar);
            $stmt->bindParam(':capacidad', $capacidad, PDO::PARAM_INT);

            // Ejecutamos
            if ($stmt->execute()) {
                $mensaje = "¡Evento tecnológico guardado con éxito!";
            } else {
                $error_db = "Hubo un problema al crear el evento.";
            }
        } catch (PDOException $e) {
            $error_db = "Error en la base de datos: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Agenda Tech - Crear Evento</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f6f8;
        }

        .btn-primary {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }

        .btn-primary:hover {
            background-color: #4338ca;
            border-color: #4338ca;
        }

        .text-primary {
            color: #4f46e5 !important;
        }

        .bg-primary-soft {
            background-color: #e0e7ff;
        }
    </style>
</head>

<body class="text-dark">
    <header class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4 py-3 sticky-top">
        <div class="container-fluid">
            <div class="d-flex align-items-center gap-3">
                <div class="p-2 rounded-3 bg-primary-soft text-primary d-flex">
                    <span class="material-symbols-outlined fs-4">calendar_add_on</span>
                </div>
                <h2 class="h5 fw-bold mb-0">Añadir Nuevo Evento</h2>
            </div>
            <div class="d-flex gap-2">
                <a href="../index.php" class="btn btn-light px-4 py-2 fw-semibold rounded-3">Cancelar</a>
            </div>
        </div>
    </header>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">

                <?php if (!empty($mensaje)): ?>
                    <div class="alert alert-success d-flex align-items-center justify-content-between mb-4 shadow-sm"
                        role="alert">
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined me-2 fs-4">check_circle</span>
                            <div class="fw-semibold"><?php echo $mensaje; ?></div>
                        </div>
                        <a href="../index.php" class="btn btn-success btn-sm fw-bold d-flex align-items-center gap-1">
                            <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                            Volver al Panel
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($error_db)): ?>
                    <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                        <span class="material-symbols-outlined me-2">error</span>
                        <div><?php echo $error_db; ?></div>
                    </div>
                <?php endif; ?>

                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                    <form action="" method="POST" class="card-body">

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-uppercase small text-muted mb-2">Nombre del Evento
                                    *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <span class="material-symbols-outlined">title</span>
                                    </span>
                                    <input name="nombre" class="form-control form-control-lg bg-light border-start-0"
                                        placeholder="Ej: Taller de Programación..." type="text" required />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-uppercase small text-muted mb-2">Lugar /
                                    Ubicación</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <span class="material-symbols-outlined">location_on</span>
                                    </span>
                                    <input name="lugar" class="form-control form-control-lg bg-light border-start-0"
                                        placeholder="Ej: Salón de Actos" type="text" />
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 mb-4 pt-4 border-top border-light-subtle">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-uppercase small text-muted mb-2">Fecha del Evento
                                    *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <span class="material-symbols-outlined">event</span>
                                    </span>
                                    <input name="fecha" class="form-control form-control-lg bg-light border-start-0"
                                        type="date" required />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-uppercase small text-muted mb-2">Capacidad
                                    (Aforo)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <span class="material-symbols-outlined">groups</span>
                                    </span>
                                    <input name="capacidad" class="form-control form-control-lg bg-light border-start-0"
                                        placeholder="Ej: 150" type="number" min="1" />
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 border-top border-light-subtle mb-5">
                            <label class="form-label fw-bold text-uppercase small text-muted mb-2">Descripción y
                                Detalles</label>
                            <textarea name="descripcion" class="form-control bg-light"
                                placeholder="Escribe aquí los detalles del evento tecnológico..." rows="5"></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" name="guardar_evento"
                                class="btn btn-primary px-5 py-3 fw-bold rounded-3 d-flex align-items-center">
                                <span class="material-symbols-outlined me-2">save</span>
                                Guardar Evento
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>