<?php

class HomeModel{

    private $database;

    public function __construct(\Database $database){
        $this->database = $database;
    }

    public function getVuelos(){
        return $this->database->consulta("SELECT * from vuelo");
    }



    public function getFechaDeViaje(){

    }

    public function getViajes(){
        return $this->database->consulta("select * from vuelo
                                                inner join viaje on vuelo.id_viaje = viaje.id_viaje;");
    }





}