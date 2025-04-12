<?php
class IniciarSesion{
    private $Usuario;
    private $Contraseña;

    public function __construct($Usuario ,$Contraseña){
    $this->Usuario = $Usuario;
    $this->Contraseña = $Contraseña;
    }

    //Metodos GET
    public function getUsuario(){
        return $this->Usuario;
    }

    public function getContraseña(){
        return $this->Contraseña;
    }

    //Metodos SET
    public function setUsuario($Usuario){
         $this->Usuario = $Usuario;
    }

    public function setContraseña($Contraseña){
         $this->Contraseña = $Contraseña;
    }

    public function guardarRegistro(){
        
    }
} 
?>