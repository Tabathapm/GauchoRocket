<?php

class PagoReservaViajeModel{

    private $database;
    public function __construct(\Database $database){
        $this->database=$database;
    }

    public function getEmpresasTarjetas(){
        return $this->database->consulta("SELECT * 
                                              FROM empresaTarjeta");
    }

    public function getRegistrarTarjeta($nroTarjeta, $titular , $vencimientoMes , $vencimientoAno, $nomTarjeta, $codSeguridad){
        return $this->database->update("INSERT INTO tarjeta_de_credito(nro_tarjeta, titular, vencimientoMes, vencimientoAno,nom_tarjeta,cod_seguridad)
                                              VALUES
                                              ('$nroTarjeta', '$titular' , '$vencimientoMes' , '$vencimientoAno', '$nomTarjeta', '$codSeguridad')");
    }

    public function actualizarReserva($id_reserva){
        return $this->database->update("UPDATE reserva
                                            SET pagado = false
                                            WHERE id_reserva = '$id_reserva';");
    }

//    --------------------------------------------------------------

    public function getReserva($reserva){

        return $this->database->consulta("SELECT r.hora_reserva as hora,
                                        c.tipo as cabina, tsb.descripcion_tipo as servicio,
                                        a.fila as fila, a.descripcion as asiento, vu.id_vuelo as vuelo,
                                        r.comprobanteReservaViaje as comprobante
                                        FROM reserva r
                                        INNER JOIN cabina c
                                        ON c.id_cabina = r.id_cabina
                                        INNER JOIN tipo_servicio_a_bordo tsb
                                        ON tsb.id_tipo_servicio = r.id_tipo_servicio
                                        INNER JOIN asiento a
                                        ON r.id_asiento = a.id_asiento
                                        INNER JOIN vuelo vu 
                                        ON vu.id_vuelo=r.id_vuelo
                                        where r.id_reserva = '$reserva'");

    }

    public function getReservaVuelo($idVuelo){

        return $this->database->consulta("SELECT d.descripcion as destino,
                                        o.descripcion as origen,
                                        vi.f_partida as fecha,
                                        vi.horario as hora,
                                        vi.precio as precio,
                                        a.fila as fila,
                                        a.descripcion as asiento
                                        from destino d
                                        inner join vuelo vu
                                        on vu.vuelo_destino=d.id_destino
                                        inner join origen o
                                        on o.id_origen= vu.vuelo_origen
                                        inner join viaje vi
                                        on vi.id_viaje = vu.id_viaje
                                        inner join asiento a 
                                        on vu.id_asiento = a.id_asiento
                                        where vu.id_vuelo='$idVuelo'");

    }



}