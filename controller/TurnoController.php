<?php

class TurnoController{

    private $render;
    private $centroMedicoModel;

    public function __construct(\Render $render, \CentroMedicoModel $centroMedicoModel){
        $this->render = $render;
        $this->centroMedicoModel = $centroMedicoModel;
    }

    public function centroMedico(){

        $data['centrosMedico'] = $this->centroMedicoModel->getCentrosMedico();

        echo $this->render->renderizar("view/centroMedico.mustache",$data);

    }

    public function execute(){
        $centroMedico=$_POST['centro-medico'];

        $turnos= $this->centroMedicoModel->getTurnosCentroMedico($centroMedico);

        $data["centroMedico"] = $centroMedico;
        $data["turnos"] =  $turnos;

        echo $this->render->renderizar("view/turno.mustache",$data);
    }

    public function turnos(){

        $centroMedico=$_POST['centro-medico'];

        $turnos= $this->centroMedicoModel->getTurnosCentroMedico($centroMedico);

        $data["centroMedico"] = $centroMedico;
        $data["turnos"] =  $turnos;

        echo $this->render->renderizar("view/turno.mustache", $data);

    }

    public function crearTurno(){

        $usuario=2;
        $idTurno=$_POST['idTurno'];

        $resultado=$this->centroMedicoModel->updateTurno($idTurno, $usuario);

        if($resultado){

            $data['estado'] = true;

        }else{
             $data['estado'] = false;
        }

        echo $this->render->renderizar("view/resultadoCheckeo.mustache", $data);
    }


}