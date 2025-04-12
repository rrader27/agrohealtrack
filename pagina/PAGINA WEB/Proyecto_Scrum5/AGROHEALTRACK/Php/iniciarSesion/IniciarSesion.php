<?php
class Usuario {
    private $correo;
    private $contraseña;

    public function __construct($correo, $contraseña) {
        $this->correo = $correo;
        $this->contraseña = $contraseña;
    }

    public function autenticar($conexion) {
        $sql = "SELECT u.*, r.rol_nombre FROM usuarios u
                INNER JOIN rol r ON u.rol_id = r.id_rol
                WHERE u.correo = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $this->correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            if (password_verify($this->contraseña, $usuario['contraseña'])) {
                return $usuario;
            }
        }
        return false;
    }
}
?>
