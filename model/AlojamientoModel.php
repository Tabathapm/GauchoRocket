<?php

class AlojamientoModel{

    private $database;

    public function __construct(\Database $database){
        $this->database = $database;
    }

    public function getAlojamientos(){
        return $this->database->consulta("SELECT * FROM ALOJAMIENTO");
    }

    public function getAlojamientoCon1Habitacion($cant_habitaciones){
        return $this->database->consulta("SELECT * FROM ALOJAMIENTO WHERE CANT_HABITACIONES = '$cant_habitaciones'");
}

    public function getAlojamientoCon2Habitaciones($cant_habitaciones){
        return $this->database->consulta("SELECT * FROM ALOJAMIENTO WHERE CANT_HABITACIONES = '$cant_habitaciones'");
    }

    public function getAlojamientoCon3Habitaciones($cant_habitaciones){
        return $this->database->consulta("SELECT * FROM ALOJAMIENTO WHERE CANT_HABITACIONES = '$cant_habitaciones'");
    }

    public function getAlojamientoCon4Habitaciones($cant_habitaciones){
        return $this->database->consulta("SELECT * FROM ALOJAMIENTO WHERE CANT_HABITACIONES = '$cant_habitaciones'");
    }









}