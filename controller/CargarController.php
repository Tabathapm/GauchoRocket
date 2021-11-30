<?php

class CargarController{
    private $render;
    private $cargarModel;

    public function __construct(\Render $render, \CargarModel $cargarModel){
        $this->render = $render;
        $this->cargarModel = $cargarModel;
    }

    public function execute(){

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
            $data['alojamiento'] = $this->homeModel->getAlojamiento();

//            var_dump($data["alojamientoElegido"]);
            echo $this->render->renderizar("view/cargar.mustache", $data);
        }
    }

    public function borrar(){
        $id_alojamiento = $_POST["idAlojamiento"];
        $this->cargarModel->getBorrarAlojamiento($id_alojamiento);

        $data["mensaje"] = "Borrado exitosamente";

        echo $this->render->renderizar("view/cargar.mustache", $data);
    }
}