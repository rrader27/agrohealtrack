<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../Formularios/iniciar_sesion.html");
    exit();
}

include '../conexion.php';
include 'ControlNutricional.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animal = $_POST['animal'] ?? '';
    $diagnostico = $_POST['diagnostico'] ?? '';
    $tratamiento = $_POST['tratamiento'] ?? '';
    $usuario_id = $_SESSION['usuario_id'];

    try {
        if (empty($animal) || empty($diagnostico) || empty($tratamiento)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        $registro = new ControlNutricional($animal, $diagnostico, $tratamiento, $usuario_id);
        $registro->guardarRegistro($conexion);

        $mensaje = urlencode("✅ Registro nutricional guardado correctamente.");
        header("Location: ../../Formularios/Control_Nutricional.html?mensaje=$mensaje");
        exit();
    } catch (Exception $e) {
        $error = urlencode("❌ Error: " . $e->getMessage());
        header("Location: ../../Formularios/Control_Nutricional.html?mensaje=$error");
        exit();
    }
}
?>
