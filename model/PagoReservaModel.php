<?php

class PagoReservaModel
{

    private $database;
    public function __construct(\Database $database){
        $this->database=$database;
    }

    public function getEmpresasTarjetas(){
        return $this->database->consulta("SELECT * 
                                              FROM empresaTarjeta");
    }

    public function getRegistrarTarjeta($nroTarjeta, $titular , $vencimientoMes , $vencimientoAno, $nomTarjeta, $codSeguridad){
        return $this->database->ejecutar("INSERT INTO tarjeta_de_credito(nro_tarjeta, titular, vencimientoMes, vencimientoAno,nom_tarjeta,cod_seguridad)
                                              VALUES
                                              ('$nroTarjeta', '$titular' , '$vencimientoMes' , '$vencimientoAno', '$nomTarjeta', '$codSeguridad')");
    }

    public function actualizarReserva($id_reserva){
        return $this->database->update("UPDATE reserva
                                            SET pagado = false
                                            WHERE id_reserva = '$id_reserva';");
    }

}