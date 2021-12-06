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

        $data = array();

        if (isset($_SESSION["logueado"])) {
            $data["logueado"] = $_SESSION["logueado"];
        }

        if (isset($_SESSION["nombre"])) {
            $data["nombre"] = $_SESSION["nombre"];
        }

        if (isset($_SESSION["esClient"])) {
            $data["esClient"] = $_SESSION["esClient"];
        }

        if (isset($data["logueado"])){

            if (isset($_POST["origen"]) && isset($_POST["destino"]) && isset($_POST["tipoViaje"]) && isset($_POST["fechaDeViaje"])){
                $origen = $_POST["origen"];
                $destino = $_POST["destino"];
                $tipoDeViaje = $_POST["tipoViaje"];
                $fechaDeViaje = $_POST["fechaDeViaje"];

                $viaje = $this->viajeModel->getViaje($origen, $destino, $tipoDeViaje, $fechaDeViaje);

                if (sizeof($viaje) == 0){
                    $data["mensajeViaje"] = "No disponemos en este momento, disculpe.";
                }else{
                    $data["viajeElegido"] = $viaje;
                }
            }elseif (isset($_POST["origen"]) && isset($_POST["destino"]) && isset($_POST["tipoViaje"])){
                $origen = $_POST["origen"];
                $destino = $_POST["destino"];
                $tipoDeViaje = $_POST["tipoViaje"];

                $viaje = $this->viajeModel->getViajeSinFecha($origen, $destino, $tipoDeViaje);

                if (sizeof($viaje) == 0){
                    $data["mensajeViaje"] = "No disponemos en este momento, disculpe.";
                }else{
                    $data["viajeElegido"] = $viaje;
                }

            }elseif (isset($_POST["origen"]) && isset($_POST["destino"]) && !isset($_POST["fechaDeViaje"])){
                $origen = $_POST["origen"];
                $destino = $_POST["destino"];
                $fechaDeViaje = $_POST["fechaDeViaje"];

                $viaje = $this->viajeModel->getViajeSinTipo($origen, $destino, $fechaDeViaje);

                if (empty($viaje)){
                    $data["mensajeViaje"] = "No disponemos en este momento, disculpe.";
                }else{
                    $data["viajeElegido"] = $viaje;
                }

            }elseif (isset($_POST["origen"]) && isset($_POST["tipoViaje"]) && !isset($_POST["fechaDeViaje"])){
                $origen = $_POST["origen"];
                $tipoDeViaje = $_POST["tipoViaje"];
                $fechaDeViaje = $_POST["fechaDeViaje"];

                $viaje = $this->viajeModel->getViajeSinDestino($origen, $tipoDeViaje, $fechaDeViaje);

                if (empty($viaje)){
                    $data["mensajeViaje"] = "No disponemos en este momento, disculpe.";
                }else{
                    $data["viajeElegido"] = $viaje;
                }

            }elseif (isset($_POST["destino"]) && isset($_POST["tipoViaje"]) && !isset($_POST["fechaDeViaje"])){
                $destino = $_POST["destino"];
                $tipoDeViaje = $_POST["tipoViaje"];
                $fechaDeViaje = $_POST["fechaDeViaje"];

                $viaje = $this->viajeModel->getViajeSinOrigen($destino, $tipoDeViaje, $fechaDeViaje);

                if (empty($viaje)){
                    $data["mensajeViaje"] = "No disponemos en este momento.";
                }else{
                    $data["viajeElegido"] = $viaje;
                }

            }elseif (isset($_POST["origen"])){
                $origen = $_POST["origen"];

                $viaje = $this->viajeModel->getViajesPorOrigen($origen);

                if (sizeof($viaje) == 0){
                    $data["mensajeViaje"] = "No disponemos en este momento viajes desde dicho origen.";
                }else{
                    $data["viajeElegido"] = $viaje;
                }

            }elseif (isset($_POST["destino"])){
                $destino = $_POST["destino"];

                $viaje = $this->viajeModel->getViajesPorDestino($destino);

                if (sizeof($viaje) == 0){
                    $data["mensajeViaje"] = "No disponemos en este momento viajes desde dicho destino.";
                }else{
                    $data["viajeElegido"] = $viaje;
                }

            }elseif (isset($_POST["tipoViaje"])){
                $tipoDeViaje = $_POST["tipoViaje"];

                $viaje = $this->viajeModel->getViajesPorTipo($tipoDeViaje);

                if (sizeof($viaje) == 0){
                    $data["mensajeViaje"] = "No disponemos en este momento viajes con dicho tipo de viaje.";
                }else{
                    $data["viajeElegido"] = $viaje;
                }

            }elseif (isset($_POST["fechaDeViaje"])){
                $fechaDeViaje = $_POST["fechaDeViaje"];

                $viaje = $this->viajeModel->getViajesPorFecha($fechaDeViaje);

                if (sizeof($viaje) == 0){
                    $data["mensajeViaje"] = "No disponemos en este momento viajes de dicha fecha.";
                }else{
                    $data["viajeElegido"] = $viaje;
                }

            }else{
                $viaje = $this->viajeModel->getTodosLosViajes();
                if (empty($viaje)){
                    $data["mensaje"] = "No hay viajes disponibles.";
                }else{
                    $data["viajeElegido"] = $viaje;
                }
            }

            echo $this->render->renderizar("view/viaje.mustache", $data);

        }
    }





}
