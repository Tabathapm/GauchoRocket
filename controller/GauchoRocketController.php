<?php

class GauchoRocketController{

    private $render;
    private $gauchoModel;

    public function __construct(\Render $render, \HomeModel $gauchoModel){
        $this->render = $render;
        $this->gauchoModel= $gauchoModel;
    }

    public function execute(){
        $data = array();
        $data['origen'] = $this->gauchoModel->getOrigen();
        $data['destino'] = $this->gauchoModel->getDestino();
        $data['tipoViaje'] = $this->gauchoModel->getTipoViaje();
        $data['4Viajes'] = $this->gauchoModel->get4Viajes();

        echo $this->render->renderizar("view/gauchoRocket.mustache", $data);

    }
}