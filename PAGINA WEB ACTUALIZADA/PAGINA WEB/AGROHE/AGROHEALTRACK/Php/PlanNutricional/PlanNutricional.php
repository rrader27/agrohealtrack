<?php 
class PlanNutriconal{
    private $Animal;
    private $PlanDieta;
    private $Suplementos;

    public function __construct($Animal, $PlanDieta, $Suplementos){
        $this->Animal = $Animal;
        $this->PlanDieta = $PlanDieta;
        $this->Suplementos = $Suplementos;
    }

    //Metodos GET
    public function getAnimal(){
        return $this->Animal;
    }

    public function getPlanDieta(){
        return $this->PlanDieta;
    }

    public function getSuplementos(){
        return $this->Suplementos;
    }

    //Meetodos SET
    public function setAnimal($Animal){
        $this->Animal = $Animal;
    }

    public function setPlanDieta($PlanDieta){
        $this->PlanDieta = $PlanDieta;
    }

    public function setSuplementos($Suplementos){
        $this->Suplementos = $Suplementos;
    }
    public function guardarRegistro(){

    }
}
?>