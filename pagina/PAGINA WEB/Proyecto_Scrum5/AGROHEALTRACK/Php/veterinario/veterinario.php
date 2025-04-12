<?php
class Veterinario {
    private $especialidad;
    private $horario;
    private $usuario_id;

    public function __construct($especialidad, $horario, $usuario_id) {
        $this->especialidad = $especialidad;
        $this->horario = $horario;
        $this->usuario_id = $usuario_id;
    }

    public function guardarConfiguracion($conexion) {
        $stmt = $conexion->prepare("INSERT INTO configuracion_veterinario (especialidad, horario_atencion, id_usuario) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $this->especialidad, $this->horario, $this->usuario_id);
        $stmt->execute();

        if ($stmt->affected_rows <= 0) {
            throw new Exception("No se pudo guardar la configuración del veterinario.");
        }

        $stmt->close();
    }
}
?>
