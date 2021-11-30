<?php

class BorrarModel{
    private $database;

    public function __construct(\Database $database){
        $this->database = $database;
    }

    public function getTodosLosViajes(){
        return $this->database->consulta("SELECT *, DATE_FORMAT(f_partida, '%d/%m/%Y') AS 'fechaDeViaje', origen.descripcion AS 'origen', destino.descripcion AS 'destino'
                                              FROM origen
                                              INNER JOIN vuelo
                                              ON origen.id_origen = vuelo.vuelo_origen
                                              INNER JOIN destino
                                              ON destino.id_destino = vuelo.vuelo_destino
                                              INNER  JOIN viaje
                                              ON vuelo.id_viaje = viaje.id_viaje
                                              INNER JOIN tipo_viaje
                                              ON viaje.id_tipo_viaje = tipo_viaje.id_tipo_viaje;");
    }

    public function getBorrarViaje($idVuelo){
        return $this->database->ejecutar("DELETE FROM viaje
                                              WHERE id_vuelo = '$idVuelo';");
    }
}