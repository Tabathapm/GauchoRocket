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

//        $data = array();
//        if (isset($_SESSION["logueado"])) {
//            $data["logueado"] = $_SESSION["logueado"];
//        }
//
//        if (isset($_SESSION["nombre"])) {
//            $data["nombre"] = $_SESSION["nombre"];
//        }
//
//        if (isset($_SESSION["esAdmin"])) {
//            $data["esAdmin"] = $_SESSION["esAdmin"];
//        }
//
//        if (isset($_SESSION["esClient"])) {
//            $data["esClient"] = $_SESSION["esClient"];
//        }
//
//        if (isset($data["logueado"])) {
//            $data["estadoLogueado"]=true;
//            echo $this->render->renderizar("view/home.mustache", $data);
//        } else {
//
//            $data["estadoLogueado"] = false;
//
//
//        }




//        $reservas=$_POST['reserva'];
//
//        $turnos= $this->reservaModel->registrarReserva($reservas);
//
//        $data["reserva"] = $reservas;
//        $data["turnos"] =  $turnos;

//        $data = array();
//
//        if (isset($_SESSION["logueado"])) {
//            $data["logueado"] = $_SESSION["logueado"];
//        }
//
//        if (isset($_SESSION["nombre"])) {
//            $data["nombre"] = $_SESSION["nombre"];
//        }
//
//        if (isset($_SESSION["esAdmin"])) {
//            $data["esAdmin"] = $_SESSION["esAdmin"];
//        }
//
//        if (isset($_SESSION["esClient"])) {
//            $data["esClient"] = $_SESSION["esClient"];
//        }
//
//        if (isset($data["logueado"])) {
//            echo $this->render->renderizar("view/reservas.mustache", $data);
//        }else{
//            echo $this->render->renderizar("view/login.mustache");
//        }

        if(isset($_SESSION['logueado'])){
            echo $this->render->renderizar("view/reservas.mustache");
        }
        else{
            header("Location: /GauchoRocket/login");
        }
    }




}




