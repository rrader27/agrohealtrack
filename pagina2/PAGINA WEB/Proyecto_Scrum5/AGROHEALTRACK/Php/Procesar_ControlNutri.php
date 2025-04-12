<?php
include '../Conexion.php';
include '../ControlNutricional/ControlNutricional.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $animal = $_POST['animal'];
    $diagnostico = $_POST['diagnostico'];
    $tratamiento = $_POST['tratamiento'];
    
    try {
        $controlNutricional = new ControlNutricional($animal, $diagnostico, $tratamiento);
        
        
        $conexion = Conexion::conectar();
        
        
        $controlNutricional->guardarRegistro($conexion);
        
        echo "¡Registro de control nutricional guardado exitosamente!";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>