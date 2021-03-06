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
        return $this->database->consulta("SELECT distinct vu.vuelo_destino,
                                          d.foto,
                                          d.descripcion,
                                          vi.id_viaje,
                                          vi.f_partida,
                                          vi.horario,
                                          vi.precio,
                                          vi.duracion,
                                          vu.id_vuelo,
                                          vu.vuelo_origen as origenid,
                                          vu.vuelo_destino as destinoid
                                          FROM vuelo vu
                                          INNER JOIN destino d 
                                          on d.id_destino=vu.vuelo_destino
                                          INNER JOIN viaje vi
                                          ON vi.id_viaje = vu.id_viaje
                                          group by vu.vuelo_destino
                                          LIMIT 4;");
    }

    public function getFechaDeViaje(){
        return $this->database->consulta("SELECT DATE_FORMAT(f_partida, '%d/%m/%Y') AS 'fechaDeViaje'
                                              FROM viaje
                                              GROUP BY f_partida;");
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
        return $this->database->consulta("SELECT *
                                              FROM alojamiento
                                              GROUP BY nombreAlojamiento;");
    }

    public function getTodosLosDestinos(){
        return $this->database->consulta("SELECT descripcion, id_destino
                                              FROM destino
                                              GROUP BY descripcion");
    }

    public function getCantidadDeHabitaciones(){
        return $this->database->consulta("SELECT DISTINCT cant_habitaciones
                                              FROM alojamiento
                                              ORDER BY cant_habitaciones ASC ;");
    }





}