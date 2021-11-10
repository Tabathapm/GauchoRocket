<?php

class ReservaController{

    private $render;
    private $reservaModel;

    public function __construct(\Render $render, \ReservaModel $reservaModel){
        $this->render = $render;
        $this->reservaModel = $reservaModel;
    }

//    public function reservas(){
//        //$data['reserva'] = $this->reservaModel->registrarReserva();
//        echo $this->render->renderizar("view/reservas.mustache");
//    }


    public function execute(){

        if(isset($_SESSION['logueado'])){
            echo $this->render->renderizar("view/reservas.mustache");
        }
        else{
            header("Location: /GauchoRocket/login");
        }





    }










//        $reservas=$_POST['reserva'];
//
//        $turnos= $this->reservaModel->registrarReserva($reservas);
//
//        $data["reserva"] = $reservas;
//        $data["turnos"] =  $turnos;


//        echo $this->render->renderizar("view/reservas.mustache");





}




