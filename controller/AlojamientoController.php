<?php

class AlojamientoController{
    private $render;
    private $alojamientoModel;


    public function __construct(\Render $render, \AlojamientoModel $alojamientoModel, ){
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

        if (isset($_SESSION["esAdmin"])) {
            $data["esAdmin"] = $_SESSION["esAdmin"];
        }

        if (isset($_SESSION["esClient"])) {
            $data["esClient"] = $_SESSION["esClient"];
        }

        $data['alojamientos'] = $this->alojamientoModel->getAlojamientos();

        if (isset($data["logueado"])) {
            if(isset($_POST['destino']) && isset($_POST['nombreAlojamiento']) && $_POST['precio'] && $_POST['cantHabitaciones']){
                $destino = $_POST['destino'];
                $nombreAlojamiento = $_POST['nombreAlojamiento'];
                $precio = $_POST['precio'];
                $cantHabitaciones = $_POST['cantHabitaciones'];

                $data['destino'] = $destino;
                $data['nombreAlojamiento']= $nombreAlojamiento;
                $data['precio'] = $precio;
                $data['cantHabitaciones'] = $cantHabitaciones;

            }

            echo $this->render->renderizar("view/alojamiento.mustache", $data);
        }

//        $destino = $_POST['destino'];
//        $nombreAlojamiento = $_POST['nombreAlojamiento'];
//        $precio = $_POST['precio'];
//        $cantHabitaciones = $_POST['cantHabitaciones'];
//
//        $data['destino'] = $destino;
//        $data['nombreAlojamiento']= $nombreAlojamiento;
//        $data['precio'] = $precio;
//        $data['cantHabitaciones'] = $cantHabitaciones;


    }

//    public function obtenerAlojamiento(){
//        $destino = $_POST['destino'];
//        $nombreAlojamiento = $_POST['nombreAlojamiento'];
//        $precio = $_POST['precio'];
//        $cantHabitaciones = $_POST['cantHabitaciones'];
//
//        $data['destino'] = $destino;
//        $data['nombreAlojamiento']= $nombreAlojamiento;
//        $data['precio'] = $precio;
//        $data['cantHabitaciones'] = $cantHabitaciones;
//
//        echo $this->render->renderizar("view/alojamiento.mustache", $data);
//
//
//    }



}
