<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    echo "Sesión activa. Usuario ID: " . $_SESSION['usuario_id'];
} else {
    echo "Sesión cerrada o no iniciada.";
}
?>