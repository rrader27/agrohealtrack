<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../Formularios/iniciar_sesion.html");
    exit();
}

include '../conexion.php';
include 'Veterinario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $especialidad = $_POST['especialidad'] ?? '';
    $horario = $_POST['horario'] ?? '';
    $usuario_id = $_SESSION['usuario_id'];

    try {
        if (empty($especialidad) || empty($horario)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        $veterinario = new Veterinario($especialidad, $horario, $usuario_id);
        $veterinario->guardarConfiguracion($conexion);

        $mensaje = urlencode("✅ Configuración guardada exitosamente");
        header("Location: ../../RegistroTrabajadores/Veterinari.html?mensaje=$mensaje");
        exit();
    } catch (Exception $e) {
        $error = urlencode("❌ Error: " . $e->getMessage());
        header("Location: ../../RegistroTrabajadores/Veterinari.html?mensaje=$error");
        exit();
    }
}
?>

