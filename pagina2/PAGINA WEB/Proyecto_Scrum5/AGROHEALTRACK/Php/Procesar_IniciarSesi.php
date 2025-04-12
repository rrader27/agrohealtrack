<?php
include '../Conexion.php';
include '../IniciarSesion/IniciarSesion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    
    try {
        $login = new IniciarSesion($usuario, $contrasena);
        
        $conexion = Conexion::conectar();
        
        $autenticado = $login->verificarCredenciales($conexion);
        
        if ($autenticado) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['autenticado'] = true;
            
            header('Location: dashboard.php');
            exit();
        } else {
            throw new Exception("Credenciales incorrectas. Por favor intente nuevamente.");
        }
    } catch (Exception $e) {

        session_start();
        $_SESSION['error_login'] = $e->getMessage();
        header('Location: login.php');
        exit();
    }
}
?>