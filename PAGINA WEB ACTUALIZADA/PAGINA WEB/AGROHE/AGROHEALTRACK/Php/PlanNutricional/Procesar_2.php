<?php
include '../Conexion.php';
include '../PlanNutricional/PlanNutricional.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $animal = $_POST['animal'];
    $planDieta = $_POST['plan_dieta'];
    $suplementos = $_POST['suplementos'];
    
    try {
        
        if (empty($animal) || empty($planDieta)) {
            throw new Exception("Los campos Animal y Plan de Dieta son obligatorios.");
        }

        $planNutricional = new PlanNutriconal($animal, $planDieta, $suplementos);
        
        $conexion = Conexion::conectar();
        
        $resultado = $planNutricional->guardarRegistro($conexion);
        
        if ($resultado) {
            session_start();
            $_SESSION['mensaje_exito'] = "Plan nutricional guardado correctamente.";
            header('Location: listado_planes.php');
            exit();
        }
    } catch (Exception $e) {
        session_start();
        $_SESSION['error'] = $e->getMessage();
        $_SESSION['datos_formulario'] = $_POST; 
        header('Location: formulario_plan_nutricional.php');
        exit();
    }
}
?>