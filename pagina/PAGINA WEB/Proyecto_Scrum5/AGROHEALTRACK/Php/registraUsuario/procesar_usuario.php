<?php 
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../conexion.php';
include 'RegistrarUsuario.php';

// 🔽 Agregamos esta función para convertir el número de tipo_usuario en nombre
function obtenerNombreRol($tipo_usuario) {
    switch ($tipo_usuario) {
        case 1: return 'usuario';
        case 2: return 'veterinario';
        case 3: return 'operario';
        case 4: return 'granjero';
        default: return 'desconocido';
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tipo_usuario = intval($_POST["tipo_usuario"]);
    $nombre = trim($_POST["nombre"]);
    $apellidos = trim($_POST["apellidos"]);
    $correo = trim($_POST["correo"]);
    $contraseña = trim($_POST["contraseña"]);

    try {
        // Validaciones
        if (empty($nombre) || empty($apellidos) || empty($correo) || empty($contraseña)) {
            throw new Exception("Todos los campos son obligatorios y no deben estar vacíos.");
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El correo no es válido.");
        }

        if (!preg_match('/[a-z]/', $contraseña) || !preg_match('/[A-Z]/', $contraseña)) {
            throw new Exception("La contraseña debe incluir mayúsculas y minúsculas.");
        }

        if (!preg_match('/[\W_]/', $contraseña)) {
            throw new Exception("La contraseña debe incluir al menos un carácter especial (ej. !, @, #, $, etc.).");
        }

        if (strlen($contraseña) < 8) {
            throw new Exception("La contraseña debe tener al menos 8 caracteres.");
        }

        // Encriptar la contraseña
        $hash_contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

        // Crear objeto usuario
        $usuario = new Usuario($nombre, $apellidos, $correo, $hash_contraseña, $tipo_usuario);

        // Verificar si el correo ya existe
        if ($usuario->correoExiste($conexion)) {
            echo "<script>
                alert('⚠️ El correo ya está registrado. Intenta con otro.');
                window.location.href = '../../Formularios/registro.html';
            </script>";
            exit();
        }

        // Guardar el usuario
        $usuario_id = $usuario->guardar($conexion);

        if ($usuario_id) {
            $_SESSION['usuario_id'] = $usuario_id;
            $_SESSION['rol'] = obtenerNombreRol($tipo_usuario); // Guardar el rol en sesión

            // Redirigir al panel de control común para todos
            echo "<script>
                alert('✅ Usuario registrado exitosamente.');
                window.location.href = '../../Pagina Principal/control_otros/Panel de  Control.html';
            </script>";
        } else {
            throw new Exception("No se pudo guardar el usuario.");
        }

    } catch (Exception $e) {
        $error = "❌ Error al registrar el usuario: " . $e->getMessage();
        echo "<script>
            alert('" . addslashes($error) . "');
            window.location.href = '../../Formularios/registro.html';
        </script>";
    }
}
?>
