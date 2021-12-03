<?php

class AlojamientoController{
    private $render;
    private $alojamientoModel;


    public function __construct(\Render $render, \AlojamientoModel $alojamientoModel){
        $this->render = $render;
        $this->alojamientoModel = $alojamientoModel;

    }

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
        if (isset($_SESSION["tipo"])) {
            $data["tipo"] = $_SESSION["tipo"];
        }

        if (isset($data["logueado"])){

            if (isset($_POST["destino"]) && isset($_POST["habitaciones"])){
                $destino = $_POST["destino"];
                $habitaciones = $_POST["habitaciones"];
                $alojamiento = $this->alojamientoModel->getAlojamiento($destino, $habitaciones);

                if (sizeof($alojamiento) == 0){
                    $data["mensaje"] = "No disponemos en este momento.";
                }else{
                    $data["alojamientoElegido"] = $alojamiento;
                }

            }elseif (isset($_POST["habitaciones"])){
                $habitaciones = $_POST["habitaciones"];
                $alojamientoPorHabitacion = $this->alojamientoModel->getAlojamientoPorHabitacion($habitaciones);

                if (sizeof($alojamientoPorHabitacion) == 0){
                    $data["mensaje"] = "No hay alojamientos con dicha cantidad de habitaciones.";
                }else{
                    $data["alojamientoElegido"] = $alojamientoPorHabitacion;
                }
            }elseif (isset($_POST["destino"])){
                $destino = $_POST["destino"];
                $alojamientoPorNombre = $this->alojamientoModel->getAlojamientoPorDestino($destino);

                if (sizeof($alojamientoPorNombre) == 0){
                    $data["mensaje"] = "No hay disponibilidad para dicho destino.";
                }else{
                    $data["alojamientoElegido"] = $alojamientoPorNombre;
                }
            }else{
                $alojamientos = $this->alojamientoModel->getTodosLosAlojamientos();

                if (sizeof($alojamientos) == 0){
                    $data["mensaje"] = "No hay alojamientos disponibles.";
                }else{
                    $data["alojamientoElegido"] = $alojamientos;
                }
            }

            echo $this->render->renderizar("view/alojamiento.mustache", $data);
        }else{
            header("Location: /GauchoRocket/");
            exit();
        }
    }

    public function obtenerAlojamiento(){
        $destino = $_POST['destino'];
        $nombreAlojamiento = $_POST['nombreAlojamiento'];
        $precio = $_POST['precio'];
        $cantHabitaciones = $_POST['cantHabitaciones'];

        $data['destino'] = $destino;
        $data['nombreAlojamiento']= $nombreAlojamiento;
        $data['precio'] = $precio;
        $data['cantHabitaciones'] = $cantHabitaciones;

        echo $this->render->renderizar("view/alojamiento.mustache", $data);


    }



}
