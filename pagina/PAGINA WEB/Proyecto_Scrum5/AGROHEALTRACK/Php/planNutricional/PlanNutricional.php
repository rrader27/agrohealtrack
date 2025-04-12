<?php
class PlanNutricional {
    private $animal;
    private $plan_dieta;
    private $suplementos;
    private $usuario_id;

    public function __construct($animal, $plan_dieta, $suplementos, $usuario_id) {
        $this->animal = $animal;
        $this->plan_dieta = $plan_dieta;
        $this->suplementos = $suplementos;
        $this->usuario_id = $usuario_id;
    }

    public function guardarPlan($conexion) {
        $stmt = $conexion->prepare("INSERT INTO plan_nutricional (plan_dieta, suplementos, usuario_id_usuario) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $this->plan_dieta, $this->suplementos, $this->usuario_id);
        $stmt->execute();

        if ($stmt->affected_rows <= 0) {
            throw new Exception("No se pudo guardar el plan nutricional.");
        }

        $stmt->close();
    }
}
?>
