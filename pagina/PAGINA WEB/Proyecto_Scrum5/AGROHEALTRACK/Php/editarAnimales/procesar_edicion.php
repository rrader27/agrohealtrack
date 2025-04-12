<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../Formularios/iniciar_sesion.html");
    exit();
}

include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $especie = $_POST['especie'];
    $raza = $_POST['raza'];
    $edad = $_POST['edad'];
    $estado = $_POST['estado'];
    $marcado = $_POST['marcado'];
    $fecha = $_POST['fecha'];
    $usuario_id = $_SESSION['usuario_id'];

    $query = "UPDATE animal SET nombre = ?, especie = ?, raza = ?, edad = ?, estado = ?, marcado = ?, fecha_ingreso = ?
              WHERE id_animal = ? AND usuario_id_usuario = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("sssssssii", $nombre, $especie, $raza, $edad, $estado, $marcado, $fecha, $id, $usuario_id);

    if ($stmt->execute()) {
        header("Location: ../../Pagina Principal/control_usuarios/Lista_animal.php?mensaje=" . urlencode("✅ Animal actualizado con éxito."));
    } else {
        echo "Error al actualizar: " . $stmt->error;
    }
}
?>
