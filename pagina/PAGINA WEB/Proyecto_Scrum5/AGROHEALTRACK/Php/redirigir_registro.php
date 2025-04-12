<?php
session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: ../iniciar_sesion.html?mensaje=" . urlencode("❌ Sesión no iniciada."));
    exit();
}

$rol = $_SESSION['rol'];

switch ($rol) {
    case 'granjero':
        header("Location: ../RegistroTrabajadores/Granjero.html");
        break;
    case 'operario':
        header("Location: ../RegistroTrabajadores/Operario.html");
        break;
    case 'veterinario':
        header("Location: ../RegistroTrabajadores/Veterinario.html");
        break;
    case 'usuario':
        header("Location: ");
        break;
    default:
        header("Location: ../iniciar_sesion.html?mensaje=" . urlencode("❌ Rol no reconocido."));
        break;
}
exit();
?>

