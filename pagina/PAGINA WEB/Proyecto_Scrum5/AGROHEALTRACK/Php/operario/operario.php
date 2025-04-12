<?php
class Operario {
    private $responsabilidades;
    private $turno;
    private $usuario_id;

    public function __construct($responsabilidades, $turno, $usuario_id) {
        $this->responsabilidades = $responsabilidades;
        $this->turno = $turno;
        $this->usuario_id = $usuario_id;
    }

    public function guardarConfiguracion($conexion) {
        $stmt = $conexion->prepare("INSERT INTO configuracion_operario (responsabilidades, turno, id_usuario) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $this->responsabilidades, $this->turno, $this->usuario_id);
        $stmt->execute();

        if ($stmt->affected_rows <= 0) {
            throw new Exception("No se pudo guardar la configuración del operario.");
        }

        $stmt->close();
    }
}
?>
