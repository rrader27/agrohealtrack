<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

class Conexion {
    private $host = "localhost";  // Servidor de la base de datos
    private $usuario = "root";  // Usuario de MySQL (cambiar si es necesario)
    private $password = "";  // Contraseña de MySQL (cambiar si tiene)
    private $baseDatos = "mr_eggs_gold";  // Reemplaza con el nombre de tu BD
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->password, $this->baseDatos);
        
        // Verificar si la conexión falló
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    // Método para obtener la conexión
    public function getConexion() {
        return $this->conexion;
    }
}
?>
