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

    public function getAlojamiento($destino, $cantHabitacion){
        return $this->database->consulta("SELECT *
                                              FROM alojamiento
                                              INNER JOIN destino on alojamiento.id_destino = destino.id_destino
                                              WHERE destino.id_destino = '$destino' AND cant_habitaciones = '$cantHabitacion';");
    }

    public function getAlojamientoPorHabitacion($cantHabitacion){
        return $this->database->consulta("SELECT *
                                              FROM alojamiento
                                              INNER JOIN destino on alojamiento.id_destino = destino.id_destino
                                              WHERE cant_habitaciones = '$cantHabitacion'");
    }

    public function getAlojamientoPorDestino($destino){
        return $this->database->consulta("SELECT *
                                              FROM alojamiento
                                              INNER JOIN destino on alojamiento.id_destino = destino.id_destino
                                              WHERE destino.id_destino = '$destino'");
    }

    public function getTodosLosAlojamientos(){
        return $this->database->consulta("SELECT *
                                              FROM alojamiento
                                              INNER JOIN destino 
                                              ON alojamiento.id_destino = destino.id_destino");
    }

    public function getAlojamientoConHabitacion($cant_habitaciones, $destino){
        return $this->database->consulta("select * from alojamiento  a   
                                                        inner join destino d on a.id_destino = d.id_destino
                                                        WHERE a.CANT_HABITACIONES = '$cant_habitaciones' AND d.descripcion = '$destino'");
    }



}