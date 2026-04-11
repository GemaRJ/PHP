<?php
session_start();
// Si no hay sesión, al login
if (!isset($_SESSION['usuario'])) {
    header("Location: autenticacion/login.php");
    exit();
}

// Conecto a la base de datos
require_once "configuracion/conexion.php";

$total_eventos = 0;
$total_asistentes = 0;
$ultimos_eventos = [];

try {
    // Calculamos el Total de Eventos
    $stmt_total = $conexion->query("SELECT COUNT(*) as total FROM eventos");
    $total_eventos = $stmt_total->fetch(PDO::FETCH_ASSOC)['total'];

    // Calculamos los Asistentes Estimados (suma de todas las capacidades)
    $stmt_capacidad = $conexion->query("SELECT SUM(capacidad) as total_capacidad FROM eventos");
    $resultado_capacidad = $stmt_capacidad->fetch(PDO::FETCH_ASSOC)['total_capacidad'];
    $total_asistentes = $resultado_capacidad ? $resultado_capacidad : 0; // Si es null, ponemos 0

    // Obtenemos los próximos 10 eventos para la tabla
    $stmt_eventos = $conexion->query("SELECT * FROM eventos ORDER BY fecha ASC LIMIT 10");
    $ultimos_eventos = $stmt_eventos->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_db = "Error de conexión: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Agenda Tech - Panel de Estudiante</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f6f8;
        }

        .sidebar {
            width: 280px;
            min-height: 100vh;
            background: white;
            border-right: 1px solid #dee2e6;
        }

        .nav-link {
            color: #6c757d;
            font-weight: 500;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: #4f46e5;
            color: white;
        }

        .nav-link.active .material-symbols-outlined {
            color: white;
        }

        .card {
            border: 1px solid #dee2e6;
            border-radius: 1rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .table-container {
            background: white;
            border-radius: 1rem;
            border: 1px solid #dee2e6;
            overflow: hidden;
        }

        .btn-primary {
            background-color: #4f46e5;
            border-color: #4f46e5;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            border-radius: 0.75rem;
        }
    </style>
</head>

<body class="text-dark">
    <div class="d-flex">

        <aside class="sidebar d-none d-lg-flex flex-column p-4">
            <div class="d-flex align-items-center gap-2 mb-4" style="color: #4f46e5;">
                <span class="material-symbols-outlined">terminal</span>
                <span class="h5 mb-0 fw-bold">Agenda Tech</span>
            </div>
            <div class="nav flex-column">
                <p class="text-uppercase text-muted fw-bold small px-3 mb-2">Menú Principal</p>
                <a class="nav-link active" href="index.php"><span
                        class="material-symbols-outlined">dashboard</span>Panel Central</a>
                <a class="nav-link" href="eventos/listar_eventos.php"><span
                        class="material-symbols-outlined">event_list</span>Ver Eventos</a>
                <a class="nav-link" href="eventos/crear_eventos.php"><span
                        class="material-symbols-outlined">add_circle</span>Añadir Evento</a>
            </div>
            <div class="mt-auto p-3 rounded-4" style="background: #f8f9ff; border: 1px solid #eef2ff;">
                <p class="fw-bold small text-uppercase mb-2" style="color: #4f46e5;">Soporte Técnico</p>
                <p class="text-muted small mb-3">¿Problemas con la plataforma? Contacta con el administrador.</p>
                <button class="btn btn-primary btn-sm w-100">Contactar</button>
            </div>
        </aside>

        <div class="flex-fill">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4 py-2">
                <div class="container-fluid">
                    <form class="d-none d-md-flex">
                        <div class="input-group" style="width: 300px;">
                            <span class="input-group-text bg-light border-0"><span
                                    class="material-symbols-outlined">search</span></span>
                            <input class="form-control bg-light border-0" placeholder="Buscar conferencias..."
                                type="text" />
                        </div>
                    </form>
                    <div class="ms-auto d-flex align-items-center gap-3">
                        <span class="fw-bold mx-2">Hola,
                            <?php echo htmlspecialchars(ucfirst($_SESSION['usuario'])); ?></span>
                        <a href="autenticacion/logout.php"
                            class="btn btn-danger btn-sm rounded-3 d-flex align-items-center"><span
                                class="material-symbols-outlined">logout</span></a>
                    </div>
                </div>
            </nav>

            <main class="p-4 p-lg-5">
                <div class="container-fluid max-width-xl">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
                        <div>
                            <h1 class="fw-black h2 mb-1">Panel de Control</h1>
                            <p class="text-muted mb-0">Resumen de tus eventos tecnológicos y hackathons.</p>
                        </div>
                        <a href="eventos/crear_eventos.php"
                            class="btn btn-primary d-flex align-items-center gap-2 shadow-sm">
                            <span class="material-symbols-outlined">add</span> Nuevo Evento
                        </a>
                    </div>

                    <?php if (isset($error_db)): ?>
                        <div class="alert alert-danger"><?php echo $error_db; ?></div>
                    <?php endif; ?>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="card p-4 h-100">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="p-2 rounded-3 text-primary" style="background: #e6efff;"><span
                                            class="material-symbols-outlined">calendar_today</span></div>
                                </div>
                                <p class="text-muted mb-1 fw-medium">Total Eventos Registrados</p>
                                <h2 class="fw-black mb-0"><?php echo $total_eventos; ?></h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-4 h-100">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="p-2 rounded-3 text-warning" style="background: #fff8e6;"><span
                                            class="material-symbols-outlined">group</span></div>
                                </div>
                                <p class="text-muted mb-1 fw-medium">Asistentes Estimados (Capacidad Total)</p>
                                <h2 class="fw-black mb-0"><?php echo $total_asistentes; ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="table-container">
                        <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                            <h5 class="mb-0 fw-bold">Próximos Eventos Destacados</h5>
                            <a href="eventos/listar_eventos.php" class="btn btn-outline-primary btn-sm">Ver todos</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4 py-3 small text-uppercase text-muted">Nombre del Evento</th>
                                        <th class="px-4 py-3 small text-uppercase text-muted">Lugar</th>
                                        <th class="px-4 py-3 small text-uppercase text-muted">Fecha</th>
                                        <th class="px-4 py-3 small text-uppercase text-muted text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($ultimos_eventos) > 0): ?>
                                        <?php foreach ($ultimos_eventos as $evento): ?>
                                            <tr>
                                                <td class="px-4 py-3">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <span
                                                            class="fw-bold text-dark"><?php echo htmlspecialchars($evento['nombre']); ?></span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-muted fw-medium">
                                                    <?php echo htmlspecialchars($evento['lugar']); ?></td>
                                                <td class="px-4 py-3 text-muted">
                                                    <?php echo date("d M Y", strtotime($evento['fecha'])); ?></td>
                                                <td class="px-4 py-3 text-end">
                                                    <a href="eventos/editar_eventos.php?id=<?php echo $evento['id']; ?>"
                                                        class="btn btn-link p-1 text-primary"><span
                                                            class="material-symbols-outlined">edit</span></a>
                                                    <a href="eventos/eliminar_eventos.php?id=<?php echo $evento['id']; ?>"
                                                        class="btn btn-link p-1 text-danger"
                                                        onclick="return confirm('¿Seguro que quieres borrarlo?');"><span
                                                            class="material-symbols-outlined">delete</span></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="px-4 py-4 text-center text-muted">
                                                No hay eventos programados. ¡Anímate a crear uno nuevo!
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>