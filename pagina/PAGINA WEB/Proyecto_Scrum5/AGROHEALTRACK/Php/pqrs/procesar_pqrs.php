<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../Formularios/iniciar_sesion.html");
    exit();
}

include '../conexion.php';
include 'PQRS.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $usuario_id = $_SESSION['usuario_id'];

    try {
        if (empty($tipo) || empty($descripcion)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        $pqrs = new PQRS($tipo, $descripcion, $usuario_id);
        $pqrs->guardar($conexion);

        $mensaje = urlencode("✅ PQRS enviada correctamente");
        header("Location: ../../Formularios/PQRS.html?mensaje=$mensaje");
        exit();
    } catch (Exception $e) {
        $error = urlencode("❌ Error: " . $e->getMessage());
        header("Location: ../../Formularios/PQRS.html?mensaje=$error");
        exit();
    }
}
?>
