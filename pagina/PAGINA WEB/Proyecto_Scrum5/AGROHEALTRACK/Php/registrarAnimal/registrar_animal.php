<?php
// Definición de la clase
class RegistrarAnimal {
    private $Nombre;
    private $Especie;
    private $Raza;
    private $Edad;
    private $Estado;
    private $Marcado;
    private $Fecha;
    private $UsuarioId;
//Constructor. se ejecutapa para crear nuevos usuarios
    public function __construct($Nombre, $Especie, $Raza, $Edad, $Estado, $Marcado, $Fecha, $UsuarioId) {
        $this->Nombre = $Nombre;
        $this->Especie = $Especie;
        $this->Raza = $Raza;
        $this->Edad = $Edad;
        $this->Estado = $Estado;
        $this->Marcado = $Marcado;
        $this->Fecha = $Fecha;
        $this->UsuarioId = $UsuarioId;}
//guarda el nuevo usuario 
    public function guardarRegistro($conexion) {
//consulta sql 
        $sql = "INSERT INTO animal (nombre, especie, raza, edad, estado, marcado, fecha_ingreso, usuario_id_usuario)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
// si falla la consulta aparece error 
        $stmt = $conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("❌ Error al preparar la consulta: " . $conexion->error);
        }

        $stmt->bind_param("sssssssi", 
            $this->Nombre, 
            $this->Especie, 
            $this->Raza, 
            $this->Edad, 
            $this->Estado, 
            $this->Marcado, 
            $this->Fecha, 
            $this->UsuarioId
        );

        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            throw new Exception("❌ Error al ejecutar la consulta: " . $stmt->error);
        }
    }
}
?>
