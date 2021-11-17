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
        $data['vuelos'] = $this->homeModel->getVuelos();


        if (isset($_SESSION["logueado"])) {
            $data["logueado"] = $_SESSION["logueado"];
        }

        if (isset($_SESSION["nombre"])) {
            $data["nombre"] = $_SESSION["nombre"];
        }

        if (isset($_SESSION["id"])) {
            $data["id"] = $_SESSION["id"];
        }

    
        if($this->homeModel->usuarioConTurno($_SESSION["id"])){

            $data['solicitoTurno']=true;

        }else{

             $data['solicitoTurno']=false;
        }

        if (isset($_SESSION["esAdmin"])) {
            $data["esAdmin"] = $_SESSION["esAdmin"];
        }

        if (isset($_SESSION["esClient"])) {
            $data["esClient"] = $_SESSION["esClient"];
        }

        if (isset($data["logueado"])) {
            echo $this->render->renderizar("view/home.mustache", $data);
        } else {
            echo $this->render->renderizar("view/gauchoRocket.mustache");
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

    
}
