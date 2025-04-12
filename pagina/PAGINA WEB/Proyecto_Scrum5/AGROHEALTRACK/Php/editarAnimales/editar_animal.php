<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../Formularios/iniciar_sesion.html");
    exit();
}

include '../conexion.php';

if (!isset($_GET['id'])) {
    die("ID de animal no proporcionado.");
}

$id = intval($_GET['id']);
$usuario_id = $_SESSION['usuario_id'];

$query = "SELECT * FROM animal WHERE id_animal = ? AND usuario_id_usuario = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("ii", $id, $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("Animal no encontrado o no autorizado.");
}

$animal = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Animal</title>
    <link rel="stylesheet" href="estilos_p.css">
</head>
<body>
    <h2>Editar Animal</h2>
    <form method="POST" action="procesar_edicion.php">
        <input type="hidden" name="id" value="<?= $animal['id_animal'] ?>">
        <label>Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($animal['nombre']) ?>"></label><br>
        <label>Especie: <input type="text" name="especie" value="<?= htmlspecialchars($animal['especie']) ?>"></label><br>
        <label>Raza: <input type="text" name="raza" value="<?= htmlspecialchars($animal['raza']) ?>"></label><br>
        <label>Edad: <input type="number" name="edad" value="<?= htmlspecialchars($animal['edad']) ?>"></label><br>
        <label>Estado: <input type="text" name="estado" value="<?= htmlspecialchars($animal['estado']) ?>"></label><br>
        <label>Marcado: <input type="text" name="marcado" value="<?= htmlspecialchars($animal['marcado']) ?>"></label><br>
        <label>Fecha Ingreso: <input type="date" name="fecha" value="<?= htmlspecialchars($animal['fecha_ingreso']) ?>"></label><br>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
