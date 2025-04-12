<?php
class PQRS {
    private $tipo;
    private $descripcion;
    private $usuario_id;

    public function __construct($tipo, $descripcion, $usuario_id) {
        $this->tipo = $tipo;
        $this->descripcion = $descripcion;
        $this->usuario_id = $usuario_id;
    }

    public function guardar($conexion) {
        $sql = "INSERT INTO pqrs (tipo, descripcion, usuario_id_usuario) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssi", $this->tipo, $this->descripcion, $this->usuario_id);

        if (!$stmt->execute()) {
            throw new Exception("Error al guardar PQRS: " . $stmt->error);
        }
    }
}
?>
