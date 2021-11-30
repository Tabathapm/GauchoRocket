<?php

class BorrarViajesController{
    private $render;
    private $borrarModel;

    public function __construct(\Render $render, \BorrarModel $borrarModel){
        $this->render = $render;
        $this->borrarModel = $borrarModel;
    }

    public function execute(){
        $data = array();

        if (isset($_SESSION["logueado"])) {
            $data["logueado"] = $_SESSION["logueado"];
        }

        if (isset($_SESSION["nombre"])) {
            $data["nombre"] = $_SESSION["nombre"];
        }

        if (isset($_SESSION["id"])) {
            $data["id"] = $_SESSION["id"];
        }

        if (isset($_SESSION["esClient"])) {
            $data["esClient"] = $_SESSION["esClient"];
        }

        if (isset($_SESSION["esAdmin"])) {
            $data["esAdmin"] = $_SESSION["esAdmin"];
        }

        if (isset($data["logueado"]) && isset($data["esAdmin"])){
            $viaje = $this->borrarModel->getTodosLosViajes();
            $data["viajeElegido"] = $viaje;
//            $data['alojamiento'] = $this->cargarModel->getAlojamiento();
//            $data["nombreDeLosDestinos"] = $this->cargarModel->getTodosLosDestinos();

            echo $this->render->renderizar("view/borrarViajes.mustache", $data);
        }
    }

    public function borrar(){
        $data = array();

        if (isset($_SESSION["logueado"])) {
            $data["logueado"] = $_SESSION["logueado"];
        }

        if (isset($_SESSION["nombre"])) {
            $data["nombre"] = $_SESSION["nombre"];
        }

        if (isset($_SESSION["id"])) {
            $data["id"] = $_SESSION["id"];
        }

        if (isset($_SESSION["esClient"])) {
            $data["esClient"] = $_SESSION["esClient"];
        }

        if (isset($_SESSION["esAdmin"])) {
            $data["esAdmin"] = $_SESSION["esAdmin"];
        }

        if (isset($data["logueado"]) && isset($data["esAdmin"])) {
            $id_vuelo = $_POST["idVuelo"];
            $this->borrarModel->getBorrarViaje($id_vuelo);

            $data["mensaje"] = "Borrado exitosamente";

            echo $this->render->renderizar("view/borrarViajes.mustache", $data);
        }
    }
}