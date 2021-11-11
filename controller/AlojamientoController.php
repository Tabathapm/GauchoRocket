<?php

class AlojamientoController{
    private $render;
    private $alojamientoModel;
    private $phpMailer;

    public function __construct(\Render $render, \AlojamientoModel $alojamientoModel, \PHPMailerGmail $phpMailer){
        $this->render = $render;
        $this->alojamientoModel = $alojamientoModel;
        $this->phpMailer = $phpMailer;
    }

    //PUSE LO DEL MAIL ASI TE LLEGA UN MAIL DE CONFIRMACION CON EL ALOJAMIENTO
    public function execute(){

    }


}
