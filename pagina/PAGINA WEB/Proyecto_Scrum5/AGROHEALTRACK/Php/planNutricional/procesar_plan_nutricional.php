<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../Formularios/iniciar_sesion.html");
    exit();
}

include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animal = $_POST['animal'] ?? '';
    $plan_dieta = $_POST['plan_dieta'] ?? '';
    $suplementos = $_POST['suplementos'] ?? '';
    $usuario_id = $_SESSION['usuario_id'];

    try {
        if (empty($animal) || empty($plan_dieta) || empty($suplementos)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        // Insertar en la base de datos
        $stmt = $conexion->prepare("INSERT INTO plan_nutricional (plan_dieta, suplementos, usuario_id_usuario) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $plan_dieta, $suplementos, $usuario_id);
        $stmt->execute();

        $mensaje = urlencode("✅ Registro de plan nutricional completo");
        header("Location: ../../Formularios/Plan_Nutricional.html?mensaje=$mensaje");
        exit();
    } catch (Exception $e) {
        $error = urlencode("❌ Error: " . $e->getMessage());
        header("Location: ../../Formularios/Plan_Nutricional.html?mensaje=$error");
        exit();
    }
}
?>
