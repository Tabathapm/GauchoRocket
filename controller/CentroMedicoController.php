<?php

class CentroMedicoController{

    private $render;
    private $centroMedicoModel;

    public function __construct(\Render $render, \CentroMedicoModel $centroMedicoModel){
        $this->render = $render;
        $this->centroMedicoModel = $centroMedicoModel;
    }

    public function centrosMedicos(){

        $data['centrosMedico'] = $this->centroMedicoModel->getCentrosMedico();

        echo $this->render->renderizar("view/centroMedico.mustache",$data);

    }

}