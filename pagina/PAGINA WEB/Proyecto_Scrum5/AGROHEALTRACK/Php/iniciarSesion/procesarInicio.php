<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['email'] ?? '';
    $contrasena = $_POST['password'] ?? '';

    if (empty($correo) || empty($contrasena)) {
        $error = urlencode("❌ Todos los campos son obligatorios.");
        header("Location: ../../Pagina Principal/iniciar_sesion.html?mensaje=$error");
        exit();
    }

    // Buscar el usuario por correo
    $sql = "SELECT u.*, r.rol_nombre 
            FROM usuarios u
            INNER JOIN rol r ON u.id_rol = r.id_rol
            WHERE u.correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($contrasena, $usuario['contraseña'])) {
            // Guardar en sesión
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['correo'] = $usuario['correo'];
            $_SESSION['rol'] = $usuario['rol_nombre'];

            $mensaje = urlencode("✅ Inicio de sesión exitoso.");

            if ($usuario['rol_nombre'] === 'usuario') {
                header("Location: ../../Pagina Principal/control_usuarios/Panel de control.html?mensaje=$mensaje");
            } else {
                header("Location: ../../Pagina Principal/control_otros/Panel de  Control.html?mensaje=$mensaje");
            }
            exit();
        } else {
            $error = urlencode("❌ Contraseña incorrecta.");
            header("Location: ../../Formularios/Iniciar_Sesion.html?mensaje=$error");
            exit();
        }
    } else {
        $error = urlencode("❌ Correo no registrado.");
        header("Location: ../../Formularios/Iniciar_Sesion.html?mensaje=$error");
        exit();
    }
}
?>
