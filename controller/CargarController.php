<?php

class CargarController{
    private $render;
    private $cargarModel;

    public function __construct(\Render $render, \CargarModel $cargarModel){
        $this->render = $render;
        $this->cargarModel = $cargarModel;
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
            $alojamientos = $this->cargarModel->getTodosLosAlojamientos();
            $data["alojamientoElegido"] = $alojamientos;
            $data['alojamiento'] = $this->cargarModel->getAlojamiento();
            $data["nombreDeLosDestinos"] = $this->cargarModel->getTodosLosDestinos();

            echo $this->render->renderizar("view/cargar.mustache", $data);
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
            $id_alojamiento = $_POST["idAlojamiento"];
            $this->cargarModel->getBorrarAlojamiento($id_alojamiento);

            $data["mensaje"] = "Borrado exitosamente";

            echo $this->render->renderizar("view/cargar.mustache", $data);
        }
    }

    public function cargarAlojamiento(){

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
            $alojamientos = $this->cargarModel->getTodosLosAlojamientos();
            $data["alojamientoElegido"] = $alojamientos;
            $data['alojamiento'] = $this->cargarModel->getAlojamiento();
            $data["nombreDeLosDestinos"] = $this->cargarModel->getTodosLosDestinos();

            if (isset($_POST["cant_habitaciones"]) && isset($_POST["destino"]) && isset($_POST["nom_alojamiento"]) && isset($_POST["precio"])) {
                $habitaciones = $_POST["cant_habitaciones"];
                $destino = $_POST["destino"];
                $alojamiento = $_POST["nom_alojamiento"];
                $precio = $_POST["precio"];

                $this->cargarModel->getCargarAlojamientos($habitaciones, $destino, $alojamiento, $precio);
                $data["mensajeCargar"] = "Se cargó exitosamente";

            }

            echo $this->render->renderizar("view/cargar.mustache", $data);
        }
    }


}