<?php
session_start();

// Protegemos la ruta
if (!isset($_SESSION['usuario'])) {
    header("Location: ../autenticacion/login.php");
    exit();
}

require_once "../configuracion/conexion.php";

$error_db = "";
$eventos = [];

// Comprobamos si el usuario ha escrito algo en el buscador
$busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

try {
    // Si hay texto en la búsqueda, hacemos un SELECT con filtro (LIKE)
    if ($busqueda != '') {
        $sql = "SELECT * FROM eventos WHERE nombre LIKE :busqueda OR lugar LIKE :busqueda OR descripcion LIKE :busqueda ORDER BY fecha ASC";
        $stmt = $conexion->prepare($sql);
        // Los % son comodines de SQL para buscar la palabra en cualquier parte del texto
        $parametro_busqueda = "%" . $busqueda . "%";
        $stmt->bindParam(':busqueda', $parametro_busqueda, PDO::PARAM_STR);
    } else {
        // Si no hay búsqueda, mostramos todos
        $stmt = $conexion->prepare("SELECT * FROM eventos ORDER BY fecha ASC");
    }

    $stmt->execute();
    $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_db = "Error al cargar los eventos: " . $e->getMessage();
}

// Recogemos posibles mensajes de éxito
$mensaje_exito = isset($_GET['msg']) && $_GET['msg'] == 'eliminado' ? "Evento eliminado correctamente." : "";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Agenda Tech - Listado de Eventos</title>

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

    .table-container {
        background: white;
        border-radius: 1rem;
        border: 1px solid #dee2e6;
        overflow: hidden;
    }

    .btn-primary {
        background-color: #4f46e5;
        border-color: #4f46e5;
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
                <a class="nav-link" href="../index.php"><span class="material-symbols-outlined">dashboard</span>Panel
                    Central</a>
                <a class="nav-link active" href="listar_eventos.php"><span
                        class="material-symbols-outlined">event_list</span>Ver Eventos</a>
                <a class="nav-link" href="crear_eventos.php"><span
                        class="material-symbols-outlined">add_circle</span>Añadir Evento</a>
            </div>
        </aside>

        <div class="flex-fill">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4 py-2">
                <div class="container-fluid">

                    <form method="GET" action="listar_eventos.php" class="d-none d-md-flex">
                        <div class="input-group" style="width: 350px;">
                            <span class="input-group-text bg-light border-0"><span
                                    class="material-symbols-outlined text-muted">search</span></span>

                            <input name="buscar" value="<?php echo htmlspecialchars($busqueda); ?>"
                                class="form-control bg-light border-0"
                                placeholder="Buscar por nombre, lugar o descripción..." type="text" />

                            <?php if ($busqueda != ''): ?>
                            <a href="listar_eventos.php"
                                class="input-group-text bg-light border-0 text-danger text-decoration-none"
                                title="Limpiar búsqueda">
                                <span class="material-symbols-outlined">close</span>
                            </a>
                            <?php endif; ?>

                            <button type="submit" class="btn btn-primary btn-sm rounded-end">Buscar</button>
                        </div>
                    </form>

                    <div class="ms-auto d-flex align-items-center gap-3">
                        <span class="fw-bold mx-2">Hola,
                            <?php echo htmlspecialchars(ucfirst($_SESSION['usuario'])); ?></span>
                        <a href="../autenticacion/logout.php" class="btn btn-danger btn-sm rounded-3"><span
                                class="material-symbols-outlined">logout</span></a>
                    </div>
                </div>
            </nav>

            <main class="p-4 p-lg-5">
                <div class="container-fluid max-width-xl">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
                        <div>
                            <h1 class="fw-black h2 mb-1">Listado de Eventos</h1>
                            <?php if ($busqueda != ''): ?>
                            <p class="text-primary fw-bold mb-0">Mostrando resultados para:
                                "<?php echo htmlspecialchars($busqueda); ?>"</p>
                            <?php else: ?>
                            <p class="text-muted mb-0">Gestiona todos los eventos tecnológicos de la base de datos.</p>
                            <?php endif; ?>
                        </div>
                        <a href="crear_eventos.php" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm">
                            <span class="material-symbols-outlined">add</span> Nuevo Evento
                        </a>
                    </div>

                    <?php if (!empty($mensaje_exito)): ?>
                    <div class="alert alert-success d-flex align-items-center mb-4 shadow-sm" role="alert">
                        <span class="material-symbols-outlined me-2">check_circle</span>
                        <div><?php echo $mensaje_exito; ?></div>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($error_db)): ?>
                    <div class="alert alert-danger d-flex align-items-center mb-4 shadow-sm" role="alert">
                        <span class="material-symbols-outlined me-2">error</span>
                        <div><?php echo $error_db; ?></div>
                    </div>
                    <?php endif; ?>

                    <div class="table-container shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4 py-3 small text-uppercase text-muted">Nombre del Evento</th>
                                        <th class="px-4 py-3 small text-uppercase text-muted">Descripción</th>
                                        <th class="px-4 py-3 small text-uppercase text-muted">Lugar</th>
                                        <th class="px-4 py-3 small text-uppercase text-muted">Fecha</th>
                                        <th class="px-4 py-3 small text-uppercase text-muted">Capacidad</th>
                                        <th class="px-4 py-3 small text-uppercase text-muted text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($eventos) > 0): ?>
                                    <?php foreach ($eventos as $evento): ?>
                                    <tr>
                                        <td class="px-4 py-3 fw-bold text-dark">
                                            <?php echo htmlspecialchars($evento['nombre']); ?></td>

                                        <td class="px-4 py-3 text-muted" style="max-width: 250px;">
                                            <?php
                                                    $desc = htmlspecialchars($evento['descripcion']);
                                                    if (strlen($desc) > 60):
                                                    ?>
                                            <?php echo substr($desc, 0, 60) . '...'; ?>
                                            <br>
                                            <button type="button"
                                                class="btn btn-link p-0 text-decoration-none fw-bold small"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalDesc<?php echo $evento['id']; ?>">
                                                Leer más
                                            </button>

                                            <div class="modal fade" id="modalDesc<?php echo $evento['id']; ?>"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow">
                                                        <div class="modal-header border-bottom-0 pb-0">
                                                            <h5 class="modal-title fw-bold">Descripción Completa</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                        </div>
                                                        <div class="modal-body text-muted pt-2 pb-4">
                                                            <?php echo nl2br($desc); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                            <?php echo $desc; ?>
                                            <?php endif; ?>
                                        </td>

                                        <td class="px-4 py-3 text-muted">
                                            <?php echo htmlspecialchars($evento['lugar']); ?></td>
                                        <td class="px-4 py-3 text-muted">
                                            <?php echo date("d/m/Y", strtotime($evento['fecha'])); ?>
                                        </td>
                                        <td class="px-4 py-3"><span
                                                class="badge bg-info text-dark rounded-pill px-3 py-2 fw-bold"><?php echo htmlspecialchars($evento['capacidad']); ?>
                                                pax</span></td>
                                        <td class="px-4 py-3 text-end">
                                            <a href="editar_eventos.php?id=<?php echo $evento['id']; ?>"
                                                class="btn btn-link p-1 text-primary" title="Editar">
                                                <span class="material-symbols-outlined">edit</span>
                                            </a>
                                            <a href="eliminar_eventos.php?id=<?php echo $evento['id']; ?>"
                                                class="btn btn-link p-1 text-danger" title="Eliminar"
                                                onclick="return confirm('¿Estás seguro de que quieres eliminar este evento?');">
                                                <span class="material-symbols-outlined">delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="px-4 py-5 text-center text-muted">
                                            <span class="material-symbols-outlined fs-1 mb-2">event_busy</span>
                                            <?php if ($busqueda != ''): ?>
                                            <p class="mb-0">No se encontraron eventos que coincidan con
                                                "<strong><?php echo htmlspecialchars($busqueda); ?></strong>".</p>
                                            <?php else: ?>
                                            <p class="mb-0">Todavía no hay eventos registrados en la base de datos.</p>
                                            <?php endif; ?>
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

</body>

</html>