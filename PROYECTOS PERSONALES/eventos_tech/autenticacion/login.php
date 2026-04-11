<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $archivo = "../usuarios.txt";

    if ($usuario === '' || $password === '') {
        $error = "Debes introducir usuario y contraseña.";
    } elseif (file_exists($archivo)) {
        $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $login_correcto = false;

        foreach ($lineas as $linea) {
            if (strpos($linea, ':') !== false) {
                list($user, $pass) = explode(':', trim($linea), 2);

                if ($usuario === trim($user) && $password === trim($pass)) {
                    $_SESSION['usuario'] = $usuario;
                    $login_correcto = true;
                    header("Location: ../index.php");
                    exit();
                }
            }
        }

        if (!$login_correcto) {
            $error = "Usuario o contraseña incorrectos.";
        }
    } else {
        $error = "No se encuentra el archivo de usuarios.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda Tech - Iniciar sesión</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, #e0e7ff 0%, transparent 35%),
                radial-gradient(circle at bottom right, #dbeafe 0%, transparent 30%),
                linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
        }

        .login-card {
            border: 0;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.10);
        }

        .login-top {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            min-height: 130px;
        }

        .icon-circle {
            width: 78px;
            height: 78px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.16);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            backdrop-filter: blur(4px);
        }

        .form-control,
        .input-group-text {
            border-radius: 0.85rem;
        }

        .input-group-text {
            background-color: #f8fafc;
            border-right: 0;
        }

        .form-control {
            background-color: #f8fafc;
            border-left: 0;
            box-shadow: none !important;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #c7d2fe;
        }

        .btn-login {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            border: 0;
            border-radius: 0.85rem;
            padding: 0.85rem 1rem;
            font-weight: 700;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #4338ca, #4f46e5);
        }

        .small-note {
            color: #64748b;
            font-size: 0.92rem;
        }
    </style>
</head>

<body class="d-flex flex-column">

    <header class="py-4">
        <div class="container">
            <div class="d-flex justify-content-center justify-content-md-start align-items-center gap-2">
                <span class="material-symbols-outlined text-primary">terminal</span>
                <span class="fw-bold fs-4 text-primary">Agenda Tech</span>
            </div>
        </div>
    </header>

    <main class="flex-grow-1 d-flex align-items-center justify-content-center px-3 pb-5">
        <div class="card login-card w-100" style="max-width: 430px;">
            <div class="login-top d-flex align-items-center justify-content-center">
                <div class="icon-circle">
                    <span class="material-symbols-outlined" style="font-size: 42px;">event_available</span>
                </div>
            </div>

            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <h1 class="h3 fw-bold mb-2">Bienvenido</h1>
                    <p class="small-note mb-0">Accede al sistema de gestión de eventos tecnológicos</p>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger d-flex align-items-center gap-2 rounded-4">
                        <span class="material-symbols-outlined">error</span>
                        <div><?php echo htmlspecialchars($error); ?></div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Usuario</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0">
                                <span class="material-symbols-outlined text-secondary">person</span>
                            </span>
                            <input type="text" name="usuario" class="form-control border-start-0"
                                placeholder="Introduce tu usuario" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0">
                                <span class="material-symbols-outlined text-secondary">lock</span>
                            </span>
                            <input type="password" name="password" class="form-control border-start-0"
                                placeholder="Introduce tu contraseña" required>
                        </div>
                    </div>

                    <button type="submit" name="login"
                        class="btn btn-login text-white w-100 d-flex align-items-center justify-content-center gap-2">
                        <span class="material-symbols-outlined">login</span>
                        Entrar
                    </button>
                </form>
            </div>
        </div>
    </main>

    <footer class="py-4 text-center">
        <p class="text-muted mb-0 small">© 2026 Agenda Tech - Práctica de gestión de eventos</p>
    </footer>

</body>

</html>