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

        $usuarioEncontrado=$this->centroMedicoModel->getUsuarioPorTurno($usuario);
        $turnoEncontrado =$this->centroMedicoModel->getTurno($idTurno);
        $centroMedicoEncontrado = $this->centroMedicoModel->getCentroMedicoPorTurno($idTurno);

        $data['turno']=$turnoEncontrado;
        $data['usuario']=$usuarioEncontrado;
        $data['centroMedico']=$centroMedicoEncontrado;


        if($resultado){

            $data['estado'] = true;

            $resultadoChequeoMedico = rand(10, 60);

            if($resultadoChequeoMedico>=10 && $resultadoChequeoMedico<30){

                $data['tipo']="Tipo 1";

            }else if($resultadoChequeoMedico>=30 && $resultadoChequeoMedico<60){

                $data['tipo']="Tipo 2";

            }else{

                $data['tipo']="Tipo 3";
            }

        }else{
             $data['estado'] = false;
        }


        echo $this->render->renderizar("view/resultadoCheckeo.mustache", $data);
    }


}