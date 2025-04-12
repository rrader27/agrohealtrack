<?php
     class ControlNutricional {
        private $Animal;
        private $Diagnostico;
        private $Tratamiento;

        public function __construct($Animal,$Diagnostico,$Tratamiento){
            $this->Animal = $Animal;
            $this->Diagnostico = $Diagnostico;
            $this->Tratamiento = $Tratamiento;
        }

    // Métodos GET 
    public function getAnimal() {
        return $this->Animal;
    }

    public function getDiagnostico() {
        return $this->Diagnostico;
    }

    public function getTratamiento() {
        return $this->Tratamiento;
    }

    // Métodos SET 
    public function setAnimal($Animal) {
        $this->Animal = $Animal;
    }

    public function setDiagnostico($Diagnostico) {
        $this->Diagnostico = $Diagnostico;
    }

    public function setTratamiento($Tratamiento) {
        $this->Tratamiento = $Tratamiento;
    }

        public function guardarRegistro() {

        }
     }

     ?>     