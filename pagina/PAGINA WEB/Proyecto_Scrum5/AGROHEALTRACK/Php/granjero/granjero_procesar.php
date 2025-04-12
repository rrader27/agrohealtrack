<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../Formularios/iniciar_sesion.html");
    exit();
}

include '../conexion.php';
include 'Granjero.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo_granja = $_POST['tipo_granja'] ?? '';
    $num_animales = $_POST['num_animales'] ?? '';
    $usuario_id = $_SESSION['usuario_id'];

    try {
        if (empty($tipo_granja) || empty($num_animales)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        if (!is_numeric($num_animales) || $num_animales <= 0) {
            throw new Exception("El número de animales debe ser un número positivo.");
        }

        $granjero = new Granjero($tipo_granja, (int)$num_animales, $usuario_id);
        $granjero->guardarConfiguracion($conexion);

        $mensaje = urlencode("✅ Configuración del granjero guardada exitosamente");
        header("Location: ../../RegistroTrabajadores/granjero.html?mensaje=$mensaje");
        exit();
    } catch (Exception $e) {
        $error = urlencode("❌ Error: " . $e->getMessage());
        header("Location: ../../RegistroTrabajadores/granjero.html?mensaje=$error");
        exit();
    }
}
?>
