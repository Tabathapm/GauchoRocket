<?php

class HomeModel{

    private $database;

    public function __construct(\Database $database){
        $this->database = $database;
    }

    public function getDestino(){
        return $this->database->consulta("SELECT * FROM destino");
    }

    public function getOrigen(){
        return $this->database->consulta("SELECT * FROM origen");
    }

    public function get4Viajes(){
        return $this->database->consulta("SELECT
                                          d.foto,
                                          d.descripcion,
                                          vi.id_viaje,
                                          vi.f_partida,
                                          vi.horario,
                                          vi.precio,
                                          vi.duracion,
                                          vu.id_vuelo
                                          FROM vuelo vu
                                          INNER JOIN viaje vi
                                          ON vi.id_viaje = vu.id_viaje
                                          INNER JOIN destino d 
                                          ON d.id_destino = vu.vuelo_destino
                                          WHERE d.id_destino BETWEEN 0 AND 5
                                          LIMIT 4");
    }

    public function getFechaDeViaje(){

    }

    public function getViajes(){
        return $this->database->consulta("select * from vuelo
                                                inner join viaje on vuelo.id_viaje = viaje.id_viaje;");
    }


    public function usuarioConTurno($id){

        return $this->database->consulta("SELECT id_usuario FROM usuario u
                                          INNER JOIN turno t
                                          ON u.id_usuario = t.usuario
                                          WHERE t.usuario='$id'");
    }

    public function getTipoViaje(){
        return $this->database->consulta("SELECT * FROM tipo_viaje");
    }

    public function getAlojamiento(){
        return $this->database->consulta("SELECT * FROM ALOJAMIENTO
                                                LIMIT 4");
    }





}