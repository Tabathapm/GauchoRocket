<?php

class TurnoController{

    private $render;
    private $centroMedicoModel;

    public function __construct(\Render $render, \CentroMedicoModel $centroMedicoModel){
        $this->render = $render;
        $this->centroMedicoModel = $centroMedicoModel;
    }


    public function centroMedico(){

     echo $this->render->renderizar("view/centroMedico.mustache");
        
    }

     public function turnos($centroMedico){

        $centroMedico=$_POST['centro-medico'];
       
        $turnos= $this->centroMedicoModel->getTurnosCentroMedico($centroMedico);

        $data["centroMedico"] = $centroMedico;
        $data["turnos"] =  $turnos;
              
        echo $this->render->renderizar("view/turno.mustache", $data);
        
    }

    public function crearTurno(){

        
    }


}