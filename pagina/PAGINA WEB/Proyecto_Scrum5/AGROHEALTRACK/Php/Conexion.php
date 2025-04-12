<?php
$host = "localhost";         //Dirección del servidor MySQL
$dbname = "agrohealtrak";   //nombre de la base de datos
$username = "root";        // usuario en mysql
$password = "1234";       // contraseña en mysql


//Crear conexión con MySQL
$conexion = new mysqli($host, $username, $password, $dbname); 


//Verificar si hay error en la conexión
if ($conexion->connect_error) {
    die("Error al conectar a la base de datos: " . $conexion->connect_error);
}
?>

