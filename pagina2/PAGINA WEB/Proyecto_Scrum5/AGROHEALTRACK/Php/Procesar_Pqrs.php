<?php
include '../Conexion.php';
include '../PQRS/pqrs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tipo_pqrs = $_POST['tipo_pqrs'];
    $descripcion = $_POST['descripcion'];
    
    try {
    
        if (empty($tipo_pqrs) || empty($descripcion)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        
        $pqrs = new Pqrs($tipo_pqrs, $descripcion);
        
        $conexion = Conexion::conectar();
        
        $resultado = $pqrs->guardarRegistro($conexion);
        
        if ($resultado) {
        
            session_start();
            $_SESSION['mensaje_exito'] = "Su PQRS ha sido registrada correctamente. N° de radicado: $resultado";
            header('Location: index.php');
            exit();
        }
    } catch (Exception $e) {

        session_start();
        $_SESSION['error'] = $e->getMessage();
        $_SESSION['datos_formulario'] = $_POST; 
        header('Location: formulario_pqrs.php');
        exit();
    }
}
?>