<?php
//muestra errores
ini_set('display_errors', 1);
error_reporting(E_ALL);
//empezar la sesion
session_start();
//verifica que el usuario inicio sesion
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../Formularios/iniciar_sesion.html");
    exit();
}
//las conexiones
include '../conexion.php';  //conexion a la base de datos
include 'registrar_animal.php'; //conexion a las clases
//Esto garantiza que el script solo se ejecuta cuando se envía el formulario mediante método POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//Obtener datos del formulario html
    $nombre = $_POST['nombre'] ?? '';
    $especie = $_POST['especie'] ?? '';
    $raza = $_POST['raza'] ?? '';
    $edad = $_POST['edad'] ?? '';
    $estado = $_POST['Salud'] ?? '';
    $marcado = $_POST['Marcado'] ?? '';
    $fecha = $_POST['fecha-ingreso'] ?? '';
//se guarda el ID del usuario que está iniciando sesión 
    $usuario_id = $_SESSION['usuario_id'];

    try {
//Validar campos obligatorios
        if (empty($nombre) || empty($especie) || empty($raza) || empty($estado) || empty($marcado) || empty($fecha)) {
            throw new Exception("Todos los campos son obligatorios.");
        }
//Crear el objeto y guardar en la base de datos
        $animal = new RegistrarAnimal($nombre, $especie, $raza, $edad, $estado, $marcado, $fecha, $usuario_id);
        $animal->guardarRegistro($conexion);

        // Redirigir al HTML con mensaje de éxito
        $mensaje = urlencode("✅ Animal registrado correctamente.");
        header("Location: ../../Formularios/registrar_animal.html?mensaje=$mensaje");
        exit();
    } catch (Exception $e) {
        $error = urlencode("❌ Error: " . $e->getMessage());
        header("Location: ../../Formularios/registrar_animal.html?mensaje=$error");
        exit();
    }
}
?>
