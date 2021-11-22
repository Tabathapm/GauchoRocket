<?php

class AlojamientoModel{

    private $database;

    public function __construct(\Database $database){
        $this->database = $database;
    }

    public function getAlojamientos(){
        return $this->database->consulta("SELECT DISTINCT nombreAlojamiento FROM ALOJAMIENTO
                                               ");
    }

    public function getAlojamientoConHabitacion($cant_habitaciones, $destino){
        return $this->database->consulta("select * from alojamiento  a   
                                                        inner join destino d on a.id_destino = d.id_destino
                                                        WHERE a.CANT_HABITACIONES = '$cant_habitaciones' AND d.descripcion = '$destino'");
}


//    public function getAlojamientoCon2Habitaciones($cant_habitaciones){
//        return $this->database->consulta("SELECT * FROM ALOJAMIENTO WHERE CANT_HABITACIONES = '$cant_habitaciones'");
//    }
//
//    public function getAlojamientoCon3Habitaciones($cant_habitaciones){
//        return $this->database->consulta("SELECT * FROM ALOJAMIENTO WHERE CANT_HABITACIONES = '$cant_habitaciones'");
//    }
//
//    public function getAlojamientoCon4Habitaciones($cant_habitaciones){
//        return $this->database->consulta("SELECT * FROM ALOJAMIENTO WHERE CANT_HABITACIONES = '$cant_habitaciones'");
//    }









}