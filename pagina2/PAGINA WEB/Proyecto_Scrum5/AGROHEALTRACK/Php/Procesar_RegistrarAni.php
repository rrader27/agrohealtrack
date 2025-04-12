<?php
include '../Conexion.php';
include '../RegistrarAnimal/RegistrarAnimal.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $especie = $_POST['especie'];
    $raza = $_POST['raza'];
    $edad = $_POST['edad'];
    $salud = $_POST['salud'];
    $marcado = isset($_POST['marcado']) ? 1 : 0; 
    $fecha = $_POST['fecha'];

    try {
        if (empty($nombre) || empty($especie) || empty($raza)) {
            throw new Exception("Nombre, especie y raza son campos obligatorios.");
        }

        
        $animal = new RegistrarAnimal($nombre, $especie, $raza, $edad, $salud, $marcado, $fecha);
        
        
        $conexion = Conexion::conectar();
        
        $resultado = $animal->guardarRegistro($conexion);
        
        if ($resultado) {
            session_start();
            $_SESSION['mensaje_exito'] = "Animal registrado correctamente con ID: $resultado";
            header('Location: listado_animales.php');
            exit();
        }
    } catch (Exception $e) {
        
        session_start();
        $_SESSION['error'] = $e->getMessage();
        $_SESSION['datos_formulario'] = $_POST; 
        header('Location: formulario_registro_animal.php');
        exit();
    }
}
?>