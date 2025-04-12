<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../Formularios/iniciar_sesion.html");
    exit();
}

include '../conexion.php';
include 'Operario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $responsabilidades = $_POST['responsabilidades'] ?? '';
    $turno = $_POST['turno'] ?? '';
    $usuario_id = $_SESSION['usuario_id'];

    try {
        if (empty($responsabilidades) || empty($turno)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        $operario = new Operario($responsabilidades, $turno, $usuario_id);
        $operario->guardarConfiguracion($conexion);

        $mensaje = urlencode("✅ Configuración guardada exitosamente");
        header("Location: ../../RegistroTrabajadores/operario.html?mensaje=$mensaje");
        exit();
    } catch (Exception $e) {
        $error = urlencode("❌ Error: " . $e->getMessage());
        header("Location: ../../RegistroTrabajadores/operario.html?mensaje=$error");
        exit();
    }
}
?>
