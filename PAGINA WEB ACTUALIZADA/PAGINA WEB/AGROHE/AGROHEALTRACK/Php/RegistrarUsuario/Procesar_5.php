<?php
include '../Conexion.php';
include '../RegistrarUsuario/RegistrarUsuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    try {
        
        if (empty($nombre) || empty($apellido) || empty($usuario) || empty($contrasena)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        if ($contrasena !== $confirmar_contrasena) {
            throw new Exception("Las contraseñas no coinciden.");
        }

        if (strlen($contrasena) < 8) {
            throw new Exception("La contraseña debe tener al menos 8 caracteres.");
        }


        $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

        
        $nuevoUsuario = new RegistrarUsuario($nombre, $apellido, $usuario, $contrasena_hash);
        
        
        $conexion = Conexion::conectar();
        
    
        if ($nuevoUsuario->existeUsuario($conexion)) {
            throw new Exception("El nombre de usuario ya está en uso.");
        }
        
        $resultado = $nuevoUsuario->guardarRegistro($conexion);
        
        if ($resultado) {
            session_start();
            $_SESSION['mensaje_exito'] = "Usuario registrado correctamente. Ya puede iniciar sesión.";
            header('Location: login.php');
            exit();
        }
    } catch (Exception $e) {
        session_start();
        $_SESSION['error'] = $e->getMessage();
        $_SESSION['datos_formulario'] = $_POST; 
        header('Location: registro.php');
        exit();
    }
}
?>