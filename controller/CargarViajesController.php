<?php

class CargarViajesController{
    private $render;
    private $cargarViajeModel;

    public function __construct(\Render $render, \CargarViajesModel $cargarViajeModel){
        $this->render = $render;
        $this->cargarViajeModel = $cargarViajeModel;
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

        if (isset($_SESSION["mensajeVueloBorrado"])){
            $data["mensajeVueloBorrado"] = $_SESSION["mensajeVueloBorrado"];
            unset($_SESSION["mensajeVueloBorrado"]);
        }

        if (isset($_SESSION["mensajeCargarViaje"])){
            $data["mensajeCargarViaje"] = $_SESSION["mensajeCargarViaje"];
            unset($_SESSION["mensajeCargarViaje"]);
        }

        if (isset($data["logueado"]) && isset($data["esAdmin"])){
            $viaje = $this->cargarViajeModel->getTodosLosViajes();
            $data["viajeElegido"] = $viaje;

            $tipoDeViaje = $this->cargarViajeModel->getTipoDeViaje();
            $data["tiposDeViajes"] = $tipoDeViaje;

            $equipos = $this->cargarViajeModel->getEquipo();
            $data["equipos"] = $equipos;

            $origen = $this->cargarViajeModel->getOrigen();
            $data["origen"] = $origen;

            $destino = $this->cargarViajeModel->getDestino();
            $data["destinos"] = $destino;

//            var_dump($this->borrarModel->getprueba());
            echo $this->render->renderizar("view/cargarViajes.mustache", $data);
        }
    }

    public function borrar(){

        if (isset($_POST["idVuelo"])) {
            $id_vuelo = $_POST["idVuelo"];
            $this->cargarViajeModel->getBorrarViaje($id_vuelo);

            $_SESSION["mensajeVueloBorrado"] = "Borrado exitosamente";

        }

        header("Location: /GauchoRocket/cargarViajes");
        exit();
    }

    public function cargarViaje(){

        if (isset($_POST["tipoDeViaje"]) && isset($_POST["fecha_partida"])
            && isset($_POST["horario"]) && isset($_POST["precio"])
            && isset($_POST["equipo"]) && isset($_POST["origen"])
            && isset($_POST["destino"])) {

            $tipoDeViaje = $_POST["tipoDeViaje"];
            $fecha = $_POST["fecha_partida"];
            $horario = $_POST["horario"];
            $precio = $_POST["precio"];
            $equipo = $_POST["equipo"];
            $origen = $_POST["origen"];
            $destino = $_POST["destino"];

            $this->cargarViajeModel->getCargarViaje($tipoDeViaje, $fecha, $horario, $precio, $equipo);

            sleep(2);

            $this->cargarViajeModel->getCargarVuelo($origen, $destino);

            $_SESSION["mensajeCargarViaje"] = "Se cargó exitosamente";

        }

        header("Location: /GauchoRocket/cargarViajes");
        exit();

    }
}