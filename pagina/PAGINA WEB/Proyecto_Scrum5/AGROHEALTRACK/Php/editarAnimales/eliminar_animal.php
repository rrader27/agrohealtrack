<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../Formularios/iniciar_sesion.html");
    exit();
}

include '../conexion.php';

if (!isset($_GET['id'])) {
    die("ID no proporcionado.");
}

$id = intval($_GET['id']);
$usuario_id = $_SESSION['usuario_id'];

$query = "DELETE FROM animal WHERE id_animal = ? AND usuario_id_usuario = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("ii", $id, $usuario_id);

if ($stmt->execute()) {
    header("Location: ../../Pagina Principal/control_usuarios/Lista_animal.php?mensaje=" . urlencode("🗑️ Animal eliminado con éxito."));
} else {
    echo "Error al eliminar: " . $stmt->error;
}
?>
