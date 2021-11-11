<?php

class ViajeController{

    private $render;
    private $viajeModel;
    private $phpMailer;

    public function __construct(\Render $render, \ViajeModel $viajeModel, \PHPMailerGmail $phpMailer){
        $this->render = $render;
        $this->viajeModel = $viajeModel;
        $this->phpMailer = $phpMailer;
    }

    //PUSE LO DEL MAIL ASI TE LLEGA UN MAIL DE CONFIRMACION CON EL VIAJE
    public function execute(){

    }





}
