<?php 
 class RegistrarUsuario{
    private $Nombre;
    private $Apellido;
    private $CrearUsuario;
    private $CrearContraseña;


    public function __construct($Nombre ,$Apellido ,$CrearUsuario ,$CrearContraseña){
      $this->Nombre = $Nombre;
      $this->Apellido = $Apellido;
      $this->CrearUsuario = $CrearUsuario;
      $this->CrearContraseña = $CrearContraseña;
 }

 //Metodo GET
 public function getNombre(){
  return $this->Nombre;
 }

 public function getApellido(){
  return $this->Apellido;
 }

 public function getcrearUsuario(){
  return $this->CrearUsuario;
 }

 public function getCrearContraseña(){
  return $this->CrearContraseña;
 }

 //Metodos SET
public function setNombre($Nombre){
  $this->Nombre = $Nombre;
}

public function setApellido($Apellido){
  $this->Apellido = $Apellido;
}

public function setCrearUsuario($CrearUsuario){
  $this->CrearUsuario = $CrearUsuario;
}

public function setCrearContraseña($CrearContraseña){
  $this->CrearContraseña = $CrearContraseña;
}


 public function guardarRegistro(){

 }  
    
 }
?>