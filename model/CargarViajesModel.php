<?php

class CargarViajesModel{
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
        return $this->database->ejecutar("DELETE FROM vuelo
                                              WHERE id_vuelo = '$idVuelo';");
    }

    public function getTipoDeViaje(){
        return $this->database->consulta("SELECT *
                                              FROM tipo_viaje");
    }

    public function getEquipo(){
        return $this->database->consulta("SELECT *
                                              FROM equipo");
    }

    public function getOrigen(){
        return $this->database->consulta("SELECT * 
                                              FROM origen;");
    }

    public function getDestino(){
        return $this->database->consulta("SELECT * 
                                              FROM destino;");
    }

    public function getCargarViaje($tipoDeViaje, $fecha, $horario, $precio, $equipo){
        return $this->database->ejecutar("INSERT INTO viaje(id_tipo_viaje,f_partida,horario,precio,dia,cant_vuelos,duracion,id_equipo, disponible)
                                              VALUES
                                              ('$tipoDeViaje', '$fecha', '$horario', '$precio', 7, 5, 8, '$equipo', true);");
    }

    public function getCargarVuelo($origen, $destino){
        return $this->database->ejecutar("INSERT INTO vuelo(duracion,capacidad_vuelo,id_cabina,id_nivel_vuelo,id_viaje,id_asiento,vuelo_origen,vuelo_destino)
                                              VALUES 
                                              (30.00, 300, 1, 1, (SELECT MAX(id_viaje) FROM viaje), null, '$origen', '$destino');");
    }

    public function getIdUltimoViaje(){
        return $this->database->consulta("SELECT id_viaje
                                              FROM viaje
                                              WHERE id_viaje = (SELECT MAX(id_viaje)
                                                                FROM viaje);");
    }
}