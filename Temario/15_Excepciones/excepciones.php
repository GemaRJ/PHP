<?php

// ==================== EXCEPCIONES PERSONALIZADAS ====================

/**
 * Excepción para longitud inválida de datos
 */
class LongitudInvalidaException extends Exception {
    public function __construct($campo, $min, $max, $code = 0, Throwable $previous = null) {
        $mensaje = "Error en $campo: debe tener entre $min y $max caracteres";
        parent::__construct($mensaje, $code, $previous);
    }
}

/**
 * Excepción para formato de email inválido
 */
class EmailInvalidoException extends Exception {
    public function __construct($email, $code = 0, Throwable $previous = null) {
        $mensaje = "Email '$email' no tiene un formato válido";
        parent::__construct($mensaje, $code, $previous);
    }
}

/**
 * Excepción para edad fuera de rango
 */
class EdadInvalidaException extends Exception {
    public function __construct($edad, $min, $max, $code = 0, Throwable $previous = null) {
        $mensaje = "Edad $edad inválida. Debe ser entre $min y $max años";
        parent::__construct($mensaje, $code, $previous);
    }
}

/**
 * Excepción para usuario o email ya existente
 */
class UsuarioExistenteException extends Exception {
    public function __construct($campo, $valor, $code = 0, Throwable $previous = null) {
        $mensaje = "Ya existe un usuario con $campo: '$valor'";
        parent::__construct($mensaje, $code, $previous);
    }
}

// ==================== CLASE USUARIO ====================

class Usuario {
    private $username;
    private $email;
    private $edad;
    private $password;
    
    /**
     * Constructor de Usuario
     * @param string $username Nombre de usuario
     * @param string $email Correo electrónico
     * @param int $edad Edad del usuario
     * @param string $password Contraseña
     */
    public function __construct($username, $email, $edad, $password) {
        $this->username = $username;
        $this->email = $email;
        $this->edad = $edad;
        $this->password = $password;
    }
    
    // Getters
    public function getUsername() { return $this->username; }
    public function getEmail() { return $this->email; }
    public function getEdad() { return $this->edad; }
    public function getPassword() { return $this->password; }
    
    /**
     * Obtiene información del usuario (sin contraseña por seguridad)
     * @return string Información formateada
     */
    public function getInfo() {
        return "Usuario: " . $this->username . 
               " | Email: " . $this->email . 
               " | Edad: " . $this->edad . " años";
    }
}

// ==================== CLASE SISTEMA REGISTRO ====================

class SistemaRegistro {
    private $usuarios = [];
    private const MIN_USERNAME = 3;
    private const MAX_USERNAME = 20;
    private const MIN_PASSWORD = 8;
    private const MIN_EDAD = 18;
    private const MAX_EDAD = 120;
    
    /**
     * Valida todos los datos de un usuario
     * @param Usuario $usuario Usuario a validar
     * @throws LongitudInvalidaException
     * @throws EmailInvalidoException
     * @throws EdadInvalidaException
     */
    private function validarDatos(Usuario $usuario) {
        // Validar username
        $longUsername = strlen($usuario->getUsername());
        if ($longUsername < self::MIN_USERNAME || $longUsername > self::MAX_USERNAME) {
            throw new LongitudInvalidaException(
                "nombre de usuario", 
                self::MIN_USERNAME, 
                self::MAX_USERNAME
            );
        }
        
        // Validar que username solo contenga letras y números
        if (!preg_match('/^[a-zA-Z0-9]+$/', $usuario->getUsername())) {
            throw new Exception(
                "El nombre de usuario solo puede contener letras y números"
            );
        }
        
        // Validar email
        if (!filter_var($usuario->getEmail(), FILTER_VALIDATE_EMAIL)) {
            throw new EmailInvalidoException($usuario->getEmail());
        }
        
        // Validar edad
        if ($usuario->getEdad() < self::MIN_EDAD || $usuario->getEdad() > self::MAX_EDAD) {
            throw new EdadInvalidaException(
                $usuario->getEdad(),
                self::MIN_EDAD,
                self::MAX_EDAD
            );
        }
        
        // Validar contraseña
        $longPassword = strlen($usuario->getPassword());
        if ($longPassword < self::MIN_PASSWORD) {
            throw new LongitudInvalidaException(
                "contraseña",
                self::MIN_PASSWORD,
                100  // Máximo arbitrario
            );
        }
    }
    
    /**
     * Verifica si el usuario ya existe
     * @param Usuario $usuario Usuario a verificar
     * @throws UsuarioExistenteException
     */
    private function verificarExistencia(Usuario $usuario) {
        foreach ($this->usuarios as $usuarioRegistrado) {
            if ($usuarioRegistrado->getUsername() === $usuario->getUsername()) {
                throw new UsuarioExistenteException(
                    "nombre de usuario",
                    $usuario->getUsername()
                );
            }
            
            if ($usuarioRegistrado->getEmail() === $usuario->getEmail()) {
                throw new UsuarioExistenteException(
                    "email",
                    $usuario->getEmail()
                );
            }
        }
    }
    
    /**
     * Registra un nuevo usuario
     * @param Usuario $usuario Usuario a registrar
     * @return bool True si se registró correctamente
     * @throws Exception Cualquier excepción de validación
     */
    public function registrarUsuario(Usuario $usuario) {
        // Paso 1: Validar datos del usuario
        $this->validarDatos($usuario);
        
        // Paso 2: Verificar que no exista
        $this->verificarExistencia($usuario);
        
        // Paso 3: Registrar usuario
        $this->usuarios[] = $usuario;
        return true;
    }
    
    /**
     * Obtiene la lista de usuarios registrados
     * @return array Lista de usuarios
     */
    public function getUsuarios() {
        return $this->usuarios;
    }
    
    /**
     * Cuenta usuarios registrados
     * @return int Número de usuarios
     */
    public function contarUsuarios() {
        return count($this->usuarios);
    }
    
    /**
     * Muestra todos los usuarios registrados
     */
    public function listarUsuarios() {
        if (empty($this->usuarios)) {
            return "No hay usuarios registrados.";
        }
        
        $lista = "=== USUARIOS REGISTRADOS ===<br>\n";
        foreach ($this->usuarios as $indice => $usuario) {
            $lista .= ($indice + 1) . ". " . $usuario->getInfo() . "<br>\n";
        }
        $lista .= "Total: " . $this->contarUsuarios() . " usuarios<br>\n";
        return $lista;
    }
}

// ==================== PROGRAMA PRINCIPAL ====================

echo "<!DOCTYPE html>\n";
echo "<html lang='es'>\n";
echo "<head>\n";
echo "    <meta charset='UTF-8'>\n";
echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>\n";
echo "    <title>Sistema de Registro con Excepciones</title>\n";
echo "    <style>\n";
echo "        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 20px; line-height: 1.6; }\n";
echo "        h1 { color: #2c3e50; border-bottom: 3px solid #3498db; padding-bottom: 10px; }\n";
echo "        h2 { color: #2980b9; }\n";
echo "        .container { max-width: 900px; margin: 0 auto; background: #f8f9fa; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }\n";
echo "        .test-case { background: white; margin: 15px 0; padding: 15px; border-left: 5px solid #3498db; border-radius: 5px; }\n";
echo "        .success { color: #27ae60; background: #d5f4e6; padding: 10px; border-radius: 5px; margin: 5px 0; }\n";
echo "        .error { color: #c0392b; background: #fadbd8; padding: 10px; border-radius: 5px; margin: 5px 0; }\n";
echo "        .warning { color: #d35400; background: #fdebd0; padding: 10px; border-radius: 5px; margin: 5px 0; }\n";
echo "        .info-box { background: #ebf5fb; padding: 15px; border-radius: 5px; margin: 20px 0; }\n";
echo "        code { background: #2c3e50; color: #ecf0f1; padding: 2px 6px; border-radius: 3px; font-family: 'Courier New', monospace; }\n";
echo "        hr { border: none; border-top: 1px dashed #bdc3c7; margin: 25px 0; }\n";
echo "    </style>\n";
echo "</head>\n";
echo "<body>\n";
echo "<div class='container'>\n";
echo "<h1>Sistema de Registro de Usuarios con Excepciones</h1>\n";
echo "<div class='info-box'>\n";
echo "    <h3>Objetivo del Sistema</h3>\n";
echo "    <p>Demostrar el uso de excepciones personalizadas en PHP para manejo de errores en un sistema de registro de usuarios.</p>\n";
echo "    <p><strong>Excepciones implementadas:</strong></p>\n";
echo "    <ul>\n";
echo "        <li><code>LongitudInvalidaException</code> - Para datos con longitud incorrecta</li>\n";
echo "        <li><code>EmailInvalidoException</code> - Para emails con formato inválido</li>\n";
echo "        <li><code>EdadInvalidaException</code> - Para edades fuera de rango (18-120)</li>\n";
echo "        <li><code>UsuarioExistenteException</code> - Para usuarios/emails duplicados</li>\n";
echo "    </ul>\n";
echo "</div>\n";

// Crear sistema de registro
$sistema = new SistemaRegistro();

echo "<h2>🧪 Pruebas de Registro</h2>\n";

// ===== PRUEBA 1: Usuario válido =====
echo "<div class='test-case'>\n";
echo "<h3>Prueba 1: Registro de usuario válido</h3>\n";
echo "<p><strong>Datos:</strong> username='maria123', email='maria@example.com', edad=25, password='claveSegura123'</p>\n";

try {
    $usuario1 = new Usuario('maria123', 'maria@example.com', 25, 'claveSegura123');
    $resultado = $sistema->registrarUsuario($usuario1);
    echo "<div class='success'>Registro exitoso: " . $usuario1->getInfo() . "</div>\n";
} catch (Exception $e) {
    echo "<div class='error'>Error: " . $e->getMessage() . "</div>\n";
}
echo "</div>\n";

// ===== PRUEBA 2: Username muy corto =====
echo "<div class='test-case'>\n";
echo "<h3>Prueba 2: Username demasiado corto</h3>\n";
echo "<p><strong>Datos:</strong> username='ab', email='corto@test.com', edad=30, password='claveLarga123'</p>\n";

try {
    $usuario2 = new Usuario('ab', 'corto@test.com', 30, 'claveLarga123');
    $resultado = $sistema->registrarUsuario($usuario2);
    echo "<div class='success' Registro exitoso: " . $usuario2->getInfo() . "</div>\n";
} catch (LongitudInvalidaException $e) {
    echo "<div class='error'>LongitudInvalidaException: " . $e->getMessage() . "</div>\n";
} catch (Exception $e) {
    echo "<div class='error'> Error: " . $e->getMessage() . "</div>\n";
}
echo "</div>\n";

// ===== PRUEBA 3: Email inválido =====
echo "<div class='test-case'>\n";
echo "<h3>Prueba 3: Email con formato inválido</h3>\n";
echo "<p><strong>Datos:</strong> username='pedro22', email='email-invalido', edad=22, password='clave1234'</p>\n";

try {
    $usuario3 = new Usuario('pedro22', 'email-invalido', 22, 'clave1234');
    $resultado = $sistema->registrarUsuario($usuario3);
    echo "<div class='success'> Registro exitoso: " . $usuario3->getInfo() . "</div>\n";
} catch (EmailInvalidoException $e) {
    echo "<div class='error'> EmailInvalidoException: " . $e->getMessage() . "</div>\n";
} catch (Exception $e) {
    echo "<div class='error'> Error: " . $e->getMessage() . "</div>\n";
}
echo "</div>\n";

// ===== PRUEBA 4: Edad menor al mínimo =====
echo "<div class='test-case'>\n";
echo "<h3>Prueba 4: Edad menor de 18 años</h3>\n";
echo "<p><strong>Datos:</strong> username='joven15', email='joven@test.com', edad=15, password='passwordLargo'</p>\n";

try {
    $usuario4 = new Usuario('joven15', 'joven@test.com', 15, 'passwordLargo');
    $resultado = $sistema->registrarUsuario($usuario4);
    echo "<div class='success'>Registro exitoso: " . $usuario4->getInfo() . "</div>\n";
} catch (EdadInvalidaException $e) {
    echo "<div class='error'> EdadInvalidaException: " . $e->getMessage() . "</div>\n";
} catch (Exception $e) {
    echo "<div class='error'> Error: " . $e->getMessage() . "</div>\n";
}
echo "</div>\n";

// ===== PRUEBA 5: Usuario duplicado =====
echo "<div class='test-case'>\n";
echo "<h3>Prueba 5: Usuario duplicado (mismo username)</h3>\n";
echo "<p><strong>Datos:</strong> username='maria123', email='otro@email.com', edad=28, password='nuevaClave123'</p>\n";

try {
    $usuario5 = new Usuario('maria123', 'otro@email.com', 28, 'nuevaClave123');
    $resultado = $sistema->registrarUsuario($usuario5);
    echo "<div class='success'>Registro exitoso: " . $usuario5->getInfo() . "</div>\n";
} catch (UsuarioExistenteException $e) {
    echo "<div class='error'> UsuarioExistenteException: " . $e->getMessage() . "</div>\n";
} catch (Exception $e) {
    echo "<div class='error'>Error: " . $e->getMessage() . "</div>\n";
}
echo "</div>\n";

// ===== PRUEBA 6: Contraseña muy corta =====
echo "<div class='test-case'>\n";
echo "<h3>Prueba 6: Contraseña demasiado corta</h3>\n";
echo "<p><strong>Datos:</strong> username='ana_secure', email='ana@example.com', edad=30, password='abc'</p>\n";

try {
    $usuario6 = new Usuario('ana_secure', 'ana@example.com', 30, 'abc');
    $resultado = $sistema->registrarUsuario($usuario6);
    echo "<div class='success'>Registro exitoso: " . $usuario6->getInfo() . "</div>\n";
} catch (LongitudInvalidaException $e) {
    echo "<div class='error'> LongitudInvalidaException: " . $e->getMessage() . "</div>\n";
} catch (Exception $e) {
    echo "<div class='error'> Error: " . $e->getMessage() . "</div>\n";
}
echo "</div>\n";

// ===== PRUEBA 7: Otro usuario válido =====
echo "<div class='test-case'>\n";
echo "<h3>Prueba 7: Otro usuario válido</h3>\n";
echo "<p><strong>Datos:</strong> username='carlos88', email='carlos@correo.com', edad=35, password='miClaveSegura88'</p>\n";

try {
    $usuario7 = new Usuario('carlos88', 'carlos@correo.com', 35, 'miClaveSegura88');
    $resultado = $sistema->registrarUsuario($usuario7);
    echo "<div class='success'> Registro exitoso: " . $usuario7->getInfo() . "</div>\n";
} catch (Exception $e) {
    echo "<div class='error'> Error: " . $e->getMessage() . "</div>\n";
}
echo "</div>\n";

// ===== PRUEBA 8: Caracteres inválidos en username =====
echo "<div class='test-case'>\n";
echo "<h3>Prueba 8: Caracteres especiales en username</h3>\n";
echo "<p><strong>Datos:</strong> username='user@test', email='test@test.com', edad=40, password='password123'</p>\n";

try {
    $usuario8 = new Usuario('user@test', 'test@test.com', 40, 'password123');
    $resultado = $sistema->registrarUsuario($usuario8);
    echo "<div class='success'> Registro exitoso: " . $usuario8->getInfo() . "</div>\n";
} catch (Exception $e) {
    echo "<div class='error'> Error: " . $e->getMessage() . "</div>\n";
}
echo "</div>\n";

echo "<hr>\n";

// ===== RESULTADOS FINALES =====
echo "<h2>Resultados Finales</h2>\n";
echo "<div class='info-box'>\n";
echo "<h3>Estadísticas del Sistema</h3>\n";
echo "<p>Total de usuarios registrados exitosamente: <strong>" . $sistema->contarUsuarios() . "</strong></p>\n";
echo "</div>\n";

echo "<h3>Listado de Usuarios Registrados</h3>\n";
echo $sistema->listarUsuarios();

echo "<hr>\n";

// ===== RESUMEN DE EXCEPCIONES =====
echo "<h2> Resumen de Excepciones Usadas</h2>\n";
echo "<div class='info-box'>\n";
echo "<p><strong>¿Por qué usar excepciones en lugar de valores de retorno?</strong></p>\n";
echo "<ul>\n";
echo "    <li><strong>Separación clara:</strong> El código principal no se mezcla con manejo de errores</li>\n";
echo "    <li><strong>Jerarquía:</strong> Podemos capturar excepciones específicas o generales</li>\n";
echo "    <li><strong>Información detallada:</strong> Cada excepción puede contener mensajes específicos</li>\n";
echo "    <li><strong>Flujo controlado:</strong> El programa no se detiene inesperadamente</li>\n";
echo "</ul>\n";
echo "<p><strong>Estructura try-catch:</strong></p>\n";
echo "<pre><code>try {\n";
echo "    // Código que puede lanzar excepciones\n";
echo "    \$sistema->registrarUsuario(\$usuario);\n";
echo "} catch (EmailInvalidoException \$e) {\n";
echo "    // Manejo específico para email inválido\n";
echo "} catch (Exception \$e) {\n";
echo "    // Manejo para cualquier otra excepción\n";
echo "}</code></pre>\n";
echo "</div>\n";

echo "<hr>\n";
echo "<p style='text-align: center; color: #7f8c8d;'>Sistema desarrollado para práctica de excepciones en PHP</p>\n";
echo "</div>\n";
echo "</body>\n";
echo "</html>\n";
?>