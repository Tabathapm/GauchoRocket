<?php

class HomeController{

    private $render;
    private $homeModel;
    public function __construct(\Render $render, \HomeModel $homeModel){
        $this->render = $render;
        $this->homeModel= $homeModel;
    }

    public function execute(){
        $data = array();
        $data['origen'] = $this->homeModel->getOrigen();
        $data['destino'] = $this->homeModel->getDestino();
        $data['tipoViaje'] = $this->homeModel->getTipoViaje();
        $data['4Viajes'] = $this->homeModel->get4Viajes();
        $data['alojamiento'] = $this->homeModel->getAlojamiento();
        $data["nombreDeLosDestinos"] = $this->homeModel->getTodosLosDestinos();
        $data["cantDeHabitaciones"] = $this->homeModel->getCantidadDeHabitaciones();
        $data["fechasDeViaje"] = $this->homeModel->getFechaDeViaje();

        if (isset($_SESSION["logueado"])) {
            $data["logueado"] = $_SESSION["logueado"];
        }

        if (isset($_SESSION["nombre"])) {
            $data["nombre"] = $_SESSION["nombre"];
        }

        if (isset($_SESSION["id"])) {
            $data["id"] = $_SESSION["id"];
        }

        if (isset($_SESSION["esAdmin"])) {
            $data["esAdmin"] = $_SESSION["esAdmin"];
        }

        if (isset($_SESSION["esClient"])) {
            $data["esClient"] = $_SESSION["esClient"];
        }

        if (isset($data["logueado"])) {
            $data["primeroElChequeo"] = "PARA PODER RESERVAR, PRIMERO DEBE REALIZARSE EL CHEQUEO MEDICO.";
            if($this->homeModel->usuarioConTurno($_SESSION["id"])){

                $data['solicitoTurno']=true;

            }else{

                $data['solicitoTurno']=false;
            }
            echo $this->render->renderizar("view/home.mustache", $data);
        } else {
//            echo $this->render->renderizar("view/gauchoRocket.mustache");
            header("Location: /GauchoRocket/");
            exit();
        }
    }

    public function obtenerViaje(){
        $origen = $_POST['origen'];
        $destino = $_POST['destino'];
        $fecha = $_POST['fecha'];
        $tipoViaje = $_POST['tipoViaje'];

        $data['origen'] = $origen;
        $data['destino'] = $destino;
        $data['fecha'] = $fecha;
        $data['tipoViaje'] = $tipoViaje;

    }

    public function obtenerDestino(){

       $destino = $_POST['destino'];
       $data['destino']=$destino;
       $habitacion = $_POST['habitacion'];
       $data['habitacion'] = $habitacion;

    }

    public function obtenerAlojamiento(){
        $data['alojamiento'] = $this->homeModel->getAlojamiento();
}
    
}
