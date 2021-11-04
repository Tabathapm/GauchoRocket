<?php

class ReservaModel
{
    private $database;
    public function __construct(\Database $database){
        $this->database=$database;
    }




    public function registrarReserva($id_reserva, $hora_reserva, $id_tarjeta, $id_vuelo,$id_tipo_servicio){
        return $this->database->ejecutar("INSERT INTO reserva(id_reserva,hora_reserva,id_tarjeta,id_vuelo,id_tipo_servicio)
                                            VALUES('$id_reserva','$hora_reserva','$id_tarjeta','$id_vuelo','$id_tipo_servicio')");
    }

}
