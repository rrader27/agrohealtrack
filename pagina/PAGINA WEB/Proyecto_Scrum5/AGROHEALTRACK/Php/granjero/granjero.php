<?php
class Granjero {
    private $tipo_granja;
    private $numero_animales;
    private $usuario_id;

    public function __construct($tipo_granja, $numero_animales, $usuario_id) {
        $this->tipo_granja = $tipo_granja;
        $this->numero_animales = $numero_animales;
        $this->usuario_id = $usuario_id;
    }

    public function guardarConfiguracion($conexion) {
        $stmt = $conexion->prepare("INSERT INTO configuracion_granjero (tipo_granja, numero_animales, id_usuario) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $this->tipo_granja, $this->numero_animales, $this->usuario_id);
        $stmt->execute();

        if ($stmt->affected_rows <= 0) {
            throw new Exception("No se pudo guardar la configuración del granjero.");
        }

        $stmt->close();
    }
}
?>
