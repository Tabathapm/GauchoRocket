<?php

class ReportesModel{

    private $database;

    public function __construct(\Database $database){
        $this->database = $database;
    }

    public function graficoViajes(){
        return $this->database->consulta("SELECT COUNT(reserva.id_cabina) AS 'cantVendido', cabina.tipo AS 'tipoDeCabina'
                                              FROM reserva
                                              INNER JOIN cabina
                                              ON reserva.id_cabina = cabina.id_cabina
                                              WHERE pagado = FALSE 
                                              GROUP BY cabina.tipo;");
    }

//    public function graficoViajes(){
//        return $this->database->consulta("SELECT *, DATE_FORMAT(f_partida, '%d/%m/%Y') AS 'fechaDeViaje', origen.descripcion AS 'Origen', destino.descripcion AS 'Destino', COUNT(viaje.disponible) AS 'cantVendido', cabina.tipo AS 'tipoDeCabina'
//                                              FROM origen
//                                              INNER JOIN vuelo
//                                              ON origen.id_origen = vuelo.vuelo_origen
//                                              INNER JOIN destino
//                                              ON destino.id_destino = vuelo.vuelo_destino
//                                              INNER  JOIN viaje
//                                              ON vuelo.id_viaje = viaje.id_viaje
//                                              INNER JOIN tipo_viaje
//                                              ON viaje.id_tipo_viaje = tipo_viaje.id_tipo_viaje
//                                              INNER JOIN cabina
//                                              ON vuelo.id_cabina = cabina.id_cabina
//                                              WHERE viaje.disponible = false
//                                              GROUP BY cabina.id_cabina;");
//    }

}