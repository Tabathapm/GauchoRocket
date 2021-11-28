<?php

class ViajeModel{

    private $database;

    public function __construct(\Database $database){
        $this->database = $database;
    }

    public function getViaje($origen, $destino, $tipoDeViaje, $fechaDeViaje){
        return $this->database->consulta("SELECT *, DATE_FORMAT(f_partida, '%d/%m/%Y') AS 'fechaDeViaje', origen.descripcion AS 'origen', destino.descripcion AS 'destino'
                                              FROM origen
                                              INNER JOIN vuelo
                                              ON origen.id_origen = vuelo.vuelo_origen
                                              INNER JOIN destino
                                              ON destino.id_destino = vuelo.vuelo_destino
                                              INNER  JOIN viaje
                                              ON vuelo.id_viaje = viaje.id_viaje
                                              INNER JOIN tipo_viaje
                                              ON viaje.id_tipo_viaje = tipo_viaje.id_tipo_viaje
                                              WHERE origen.id_origen = '$origen' 
                                                AND destino.id_destino = '$destino' 
                                                AND tipo_viaje.id_tipo_viaje = '$tipoDeViaje' 
                                                AND DATE_FORMAT(f_partida, '%d/%m/%Y') = '$fechaDeViaje';");
    }

    public function getViajeSinFecha($origen, $destino, $tipoDeViaje){
        return $this->database->consulta("SELECT *, DATE_FORMAT(f_partida, '%d/%m/%Y') AS 'fechaDeViaje', origen.descripcion AS 'origen', destino.descripcion AS 'destino'
                                              FROM origen
                                              INNER JOIN vuelo
                                              ON origen.id_origen = vuelo.vuelo_origen
                                              INNER JOIN destino
                                              ON destino.id_destino = vuelo.vuelo_destino
                                              INNER  JOIN viaje
                                              ON vuelo.id_viaje = viaje.id_viaje
                                              INNER JOIN tipo_viaje
                                              ON viaje.id_tipo_viaje = tipo_viaje.id_tipo_viaje
                                              WHERE origen.id_origen = '$origen' 
                                                AND destino.id_destino = '$destino' 
                                                AND tipo_viaje.id_tipo_viaje = '$tipoDeViaje';");
    }

    public function getViajeSinTipo($origen, $destino, $fechaDeViaje){
        return $this->database->consulta("SELECT *, DATE_FORMAT(f_partida, '%d/%m/%Y') AS 'fechaDeViaje', origen.descripcion AS 'origen', destino.descripcion AS 'destino'
                                              FROM origen
                                              INNER JOIN vuelo
                                              ON origen.id_origen = vuelo.vuelo_origen
                                              INNER JOIN destino
                                              ON destino.id_destino = vuelo.vuelo_destino
                                              INNER  JOIN viaje
                                              ON vuelo.id_viaje = viaje.id_viaje
                                              INNER JOIN tipo_viaje
                                              ON viaje.id_tipo_viaje = tipo_viaje.id_tipo_viaje
                                              WHERE origen.id_origen = '$origen' 
                                                AND destino.id_destino = '$destino'
                                                AND DATE_FORMAT(f_partida, '%d/%m/%Y') = '$fechaDeViaje';");
    }

    public function getViajeSinDestino($origen, $tipoDeViaje, $fechaDeViaje){
        return $this->database->consulta("SELECT *, DATE_FORMAT(f_partida, '%d/%m/%Y') AS 'fechaDeViaje', origen.descripcion AS 'origen', destino.descripcion AS 'destino'
                                              FROM origen
                                              INNER JOIN vuelo
                                              ON origen.id_origen = vuelo.vuelo_origen
                                              INNER JOIN destino
                                              ON destino.id_destino = vuelo.vuelo_destino
                                              INNER  JOIN viaje
                                              ON vuelo.id_viaje = viaje.id_viaje
                                              INNER JOIN tipo_viaje
                                              ON viaje.id_tipo_viaje = tipo_viaje.id_tipo_viaje
                                              WHERE origen.id_origen = '$origen'
                                                AND tipo_viaje.id_tipo_viaje = '$tipoDeViaje' 
                                                AND DATE_FORMAT(f_partida, '%d/%m/%Y') = '$fechaDeViaje';");
    }

    public function getViajeSinOrigen($destino, $tipoDeViaje, $fechaDeViaje){
        return $this->database->consulta("SELECT *, DATE_FORMAT(f_partida, '%d/%m/%Y') AS 'fechaDeViaje', origen.descripcion AS 'origen', destino.descripcion AS 'destino'
                                              FROM origen
                                              INNER JOIN vuelo
                                              ON origen.id_origen = vuelo.vuelo_origen
                                              INNER JOIN destino
                                              ON destino.id_destino = vuelo.vuelo_destino
                                              INNER  JOIN viaje
                                              ON vuelo.id_viaje = viaje.id_viaje
                                              INNER JOIN tipo_viaje
                                              ON viaje.id_tipo_viaje = tipo_viaje.id_tipo_viaje
                                              WHERE destino.id_destino = '$destino' 
                                                AND tipo_viaje.id_tipo_viaje = '$tipoDeViaje' 
                                                AND DATE_FORMAT(f_partida, '%d/%m/%Y') = '$fechaDeViaje';");
    }

    public function getViajesPorOrigen($origen){
        return $this->database->consulta("SELECT *, DATE_FORMAT(f_partida, '%d/%m/%Y') AS 'fechaDeViaje', origen.descripcion AS 'origen', destino.descripcion AS 'destino'
                                              FROM origen
                                              INNER JOIN vuelo
                                              ON origen.id_origen = vuelo.vuelo_origen
                                              INNER JOIN destino
                                              ON destino.id_destino = vuelo.vuelo_destino
                                              INNER  JOIN viaje
                                              ON vuelo.id_viaje = viaje.id_viaje
                                              INNER JOIN tipo_viaje
                                              ON viaje.id_tipo_viaje = tipo_viaje.id_tipo_viaje
                                              WHERE origen.id_origen = '$origen' ;");
    }

    public function getViajesPorDestino($destino){
        return $this->database->consulta("SELECT *, DATE_FORMAT(f_partida, '%d/%m/%Y') AS 'fechaDeViaje', origen.descripcion AS 'origen', destino.descripcion AS 'destino'
                                              FROM origen
                                              INNER JOIN vuelo
                                              ON origen.id_origen = vuelo.vuelo_origen
                                              INNER JOIN destino
                                              ON destino.id_destino = vuelo.vuelo_destino
                                              INNER  JOIN viaje
                                              ON vuelo.id_viaje = viaje.id_viaje
                                              INNER JOIN tipo_viaje
                                              ON viaje.id_tipo_viaje = tipo_viaje.id_tipo_viaje
                                              WHERE destino.id_destino = '$destino' ;");
    }

    public function getViajesPorTipo($tipoDeViaje){
        return $this->database->consulta("SELECT *, DATE_FORMAT(f_partida, '%d/%m/%Y') AS 'fechaDeViaje', origen.descripcion AS 'origen', destino.descripcion AS 'destino'
                                              FROM origen
                                              INNER JOIN vuelo
                                              ON origen.id_origen = vuelo.vuelo_origen
                                              INNER JOIN destino
                                              ON destino.id_destino = vuelo.vuelo_destino
                                              INNER  JOIN viaje
                                              ON vuelo.id_viaje = viaje.id_viaje
                                              INNER JOIN tipo_viaje
                                              ON viaje.id_tipo_viaje = tipo_viaje.id_tipo_viaje
                                              WHERE tipo_viaje.id_tipo_viaje= '$tipoDeViaje' ;");
    }

    public function getViajesPorFecha($fechaDeViaje){
        return $this->database->consulta("SELECT *, DATE_FORMAT(f_partida, '%d/%m/%Y') AS 'fechaDeViaje', origen.descripcion AS 'origen', destino.descripcion AS 'destino'
                                              FROM origen
                                              INNER JOIN vuelo
                                              ON origen.id_origen = vuelo.vuelo_origen
                                              INNER JOIN destino
                                              ON destino.id_destino = vuelo.vuelo_destino
                                              INNER  JOIN viaje
                                              ON vuelo.id_viaje = viaje.id_viaje
                                              INNER JOIN tipo_viaje
                                              ON viaje.id_tipo_viaje = tipo_viaje.id_tipo_viaje
                                              WHERE DATE_FORMAT(f_partida, '%d/%m/%Y') = '$fechaDeViaje';");
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
}