<?php
class ControlNutricional {
    private $animal;
    private $diagnostico;
    private $tratamiento;
    private $usuario_id;

    public function __construct($animal, $diagnostico, $tratamiento, $usuario_id) {
        $this->animal = $animal;
        $this->diagnostico = $diagnostico;
        $this->tratamiento = $tratamiento;
        $this->usuario_id = $usuario_id;
    }

    public function guardarRegistro($conexion) {
        $sql = "INSERT INTO control_nutricional (animal, diagnostico, tratamiento, usuario_id_usuario) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssi", $this->animal, $this->diagnostico, $this->tratamiento, $this->usuario_id);
        return $stmt->execute();
    }
}
?>

