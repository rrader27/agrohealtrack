<?php
class RegistrarAnimal{
     private $Nombre;
     private $Especie;
     private $Raza;
     private $Edad;
     private $Salud;
     private $Marcado;
     private $Fecha;

     public function __construct($Nombre, $Especie, $Raza ,$Edad ,$Salud ,$Marcado ,$Fecha ){
        $this->Nombre = $Nombre;
        $this->Especie = $Especie;
        $this->Raza = $Raza;
        $this->Edad = $Edad;
        $this->Salud = $Salud;
        $this->Marcado = $Marcado;
        $this->Fecha = $Fecha;
     }

     //Metodos GET
     public function getNombre(){
      return $this->Nombre;
     }

     public function getEspecie(){
      return $this->Especie;
     }

     public function getRaza(){
      return $this->Raza;
     }

     public function getEdad(){
      return $this->Edad;
     }

     public function getSalud(){
      return $this->Salud;
     }

     public function getMarcado(){
      return $this->Marcado;
     }

     public function getFecha(){
      return $this->Fecha;
     }

     //Metodo SET
     public function setNombre($Nombre){
      $this->Nombre = $Nombre;
     }

     public function setEspecie($Especie){
      $this->Especie = $Especie;
     }

     public function setRaza($Raza){
      $this->Raza = $Raza;
     }

     public function setEdad($Edad){
      $this->Edad = $Edad;
     }

     public function setSalud($Salud){
      $this->Salud = $Salud;
     }

     public function setMarcado($Marcado){
      $this->Marcado = $Marcado;
     }

     public function setFecha($Fecha){
      $this->Fecha = $Fecha;
     }

     public function guardarRegistro(){
        
     }
     
} 
?>