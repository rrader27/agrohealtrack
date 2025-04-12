<?php
session_start();         // Inicia sesión para poder destruirla
session_unset();         // Limpia todas las variables de sesión
session_destroy();       // Destruye la sesión completamente

// Redirige al login o página principal
header("Location: ../../Pagina_incio.html");
exit();
?>