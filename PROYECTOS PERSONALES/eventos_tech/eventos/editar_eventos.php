<?php
session_start();

// Protegemos la ruta
if (!isset($_SESSION['usuario'])) {
    header("Location: ../autenticacion/login.php");
    exit();
}

require_once "../configuracion/conexion.php";

$mensaje = "";
$error_db = "";
$evento = null;

// OBTENER LOS DATOS DEL EVENTO (Vía GET)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Consulta preparada para sacar los datos actuales del evento. Lo que recomendaste en clase aplicarlo aquí, lo hice.
        $stmt = $conexion->prepare("SELECT * FROM eventos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $evento = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$evento) {
            $error_db = "El evento que intentas editar no existe.";
        }
    } catch (PDOException $e) {
        $error_db = "Error al cargar el evento: " . $e->getMessage();
    }
} else {
    // Si alguien entra sin poner un ID en la URL, lo devolvemos al inicio
    header("Location: ../index.php");
    exit();
}

// ACTUALIZAR LOS DATOS DEL EVENTO (Vía POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar_evento'])) {
    $nombre = trim($_POST['nombre']);
    $fecha = trim($_POST['fecha']);
    $lugar = trim($_POST['lugar']);
    $capacidad = trim($_POST['capacidad']);
    $descripcion = trim($_POST['descripcion']);

    if (empty($nombre) || empty($fecha)) {
        $error_db = "Los campos Nombre y Fecha son obligatorios.";
    } else {
        try {
            // Consulta Preparada UPDATE para evitar inyección SQL
            $sql = "UPDATE eventos SET nombre = :nombre, fecha = :fecha, descripcion = :descripcion, lugar = :lugar, capacidad = :capacidad WHERE id = :id";

            $stmt_update = $conexion->prepare($sql);

            $stmt_update->bindParam(':nombre', $nombre);
            $stmt_update->bindParam(':fecha', $fecha);
            $stmt_update->bindParam(':descripcion', $descripcion);
            $stmt_update->bindParam(':lugar', $lugar);
            $stmt_update->bindParam(':capacidad', $capacidad, PDO::PARAM_INT);
            $stmt_update->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt_update->execute()) {
                $mensaje = "¡Evento tecnológico actualizado con éxito!";

                // Actualizamos la variable $evento para que el formulario muestre los datos recién guardados
                $evento['nombre'] = $nombre;
                $evento['fecha'] = $fecha;
                $evento['lugar'] = $lugar;
                $evento['capacidad'] = $capacidad;
                $evento['descripcion'] = $descripcion;
            } else {
                $error_db = "Hubo un problema al actualizar el evento.";
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
    <title>Agenda Tech - Editar Evento</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
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
                    <span class="material-symbols-outlined fs-4">edit_calendar</span>
                </div>
                <h2 class="h5 fw-bold mb-0">Editar Evento</h2>
            </div>
            <div class="d-flex gap-2">
                <a href="../index.php" class="btn btn-light px-4 py-2 fw-semibold rounded-3">Volver</a>
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
                            Ir al Panel
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($error_db)): ?>
                    <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                        <span class="material-symbols-outlined me-2">error</span>
                        <div><?php echo $error_db; ?></div>
                    </div>
                <?php endif; ?>

                <?php if ($evento): ?>
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
                                        <input name="nombre" value="<?php echo htmlspecialchars($evento['nombre']); ?>"
                                            class="form-control form-control-lg bg-light border-start-0" type="text"
                                            required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-uppercase small text-muted mb-2">Lugar /
                                        Ubicación</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <span class="material-symbols-outlined">location_on</span>
                                        </span>
                                        <input name="lugar" value="<?php echo htmlspecialchars($evento['lugar']); ?>"
                                            class="form-control form-control-lg bg-light border-start-0" type="text" />
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
                                        <input name="fecha" value="<?php echo htmlspecialchars($evento['fecha']); ?>"
                                            class="form-control form-control-lg bg-light border-start-0" type="date"
                                            required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-uppercase small text-muted mb-2">Capacidad
                                        (Aforo)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <span class="material-symbols-outlined">groups</span>
                                        </span>
                                        <input name="capacidad"
                                            value="<?php echo htmlspecialchars($evento['capacidad']); ?>"
                                            class="form-control form-control-lg bg-light border-start-0" type="number"
                                            min="1" />
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 border-top border-light-subtle mb-5">
                                <label class="form-label fw-bold text-uppercase small text-muted mb-2">Descripción y
                                    Detalles</label>
                                <textarea name="descripcion" class="form-control bg-light"
                                    rows="5"><?php echo htmlspecialchars($evento['descripcion']); ?></textarea>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" name="actualizar_evento"
                                    class="btn btn-primary px-5 py-3 fw-bold rounded-3 d-flex align-items-center">
                                    <span class="material-symbols-outlined me-2">update</span>
                                    Actualizar Evento
                                </button>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>