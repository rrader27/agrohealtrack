<?php
class Usuario {
    public $nombre;
    public $apellidos;
    public $correo;
    public $contraseña;
    public $id_rol;

    public function __construct($nombre, $apellidos, $correo, $contraseña, $id_rol) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->contraseña = $contraseña;
        $this->id_rol = $id_rol;
    }

    public function correoExiste($conexion) {
        $sql = "SELECT id_usuario FROM usuarios WHERE correo = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $this->correo);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function guardar($conexion) {
        $sql = "INSERT INTO usuarios (nombre, apellidos, correo, contraseña, id_rol) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssssi", $this->nombre, $this->apellidos, $this->correo, $this->contraseña, $this->id_rol);
        
        if ($stmt->execute()) {
            return $conexion->insert_id; // ✅ Esto es correcto con MySQLi
        } else {
            return false;
        }
    }
}
?>
