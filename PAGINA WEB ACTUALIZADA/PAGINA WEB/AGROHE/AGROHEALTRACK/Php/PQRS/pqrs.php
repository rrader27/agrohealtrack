<?php  
 class Pqrs{
    private $Tipo_pqrs;
    private $Descripcion;


public function __construct($Tipo_pqrs ,$Descripcion){
  $this->Tipo_pqrs= $Tipo_pqrs;
  $this->Descripcion= $Descripcion;
}

//Metodos GET
public function getTipo_pqrs(){
  return $this->Tipo_pqrs;
}

public function getDescripcion(){
  return $this->Descripcion;
}

//Metodos SET
public function setTipo_pqrs($Tipo_pqrs){
  $this->Tipo_pqrs = $Tipo_pqrs;
}

public function setDescripcion($Descripcion){
  $this->Descripcion = $Descripcion;
}

public function guardarRegistro(){
    
}

 } 

?>