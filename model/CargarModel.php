<?php

class CargarModel{
    private $database;

    public function __construct(\Database $database){
        $this->database = $database;
    }

    public function getTodosLosAlojamientos(){
        return $this->database->consulta("SELECT *
                                              FROM alojamiento
                                              INNER JOIN destino 
                                              ON alojamiento.id_destino = destino.id_destino");
    }

    public function getBorrarAlojamiento($id_alojamiento){
        return $this->database->ejecutar("DELETE FROM alojamiento
                                              WHERE id_alojamiento = '$id_alojamiento';");
    }
}