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
        $data['vuelos'] = $this->gauchoModel->getVuelos();

        echo $this->render->renderizar("view/gauchoRocket.mustache", $data);

    }
}