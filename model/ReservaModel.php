<?php

class ReservaModel
{
    private $database;
    public function __construct(\Database $database){
        $this->database=$database;
    }

    public function registrarReserva($hora_reserva,  $id_vuelo,$id_asiento,$id_tipo_servicio, $id_cabina, $id_usuario,$idViaje, $comprobanteReservaViaje){
        return $this->database->update("INSERT INTO reserva(hora_reserva,id_vuelo,id_asiento,id_tipo_servicio,id_cabina, id_usuario,id_viaje,comprobanteReservaViaje, pagado)
                                           VALUES
                                          ('$hora_reserva','$id_vuelo','$id_asiento','$id_tipo_servicio','$id_cabina','$id_usuario','$idViaje','$comprobanteReservaViaje' ,true)");
    }

    public function servicios(){
        return $this->database->consulta("SELECT * FROM tipo_servicio_a_bordo");
    }

     public function cabinas(){
        return $this->database->consulta("SELECT DISTINCT tipo, id_cabina FROM cabina");
    }

    public function getServicio($id){
        return $this->database->consulta("SELECT * FROM tipo_servicio_a_bordo
                                          WHERE id_tipo_servicio='$id'");
    }


    public function viajes(){
        return $this->database->consulta("SELECT * FROM VIAJE");

    }

    public function getCabina($id){
        return $this->database->consulta("SELECT * FROM cabina
                                          WHERE id_cabina ='$id'");
    }

    public function getViaje($id){
        return $this->database->consulta("SELECT * FROM viaje vi
                                          INNER JOIN vuelo vu
                                          ON vi.id_viaje = vu.id_viaje
                                          WHERE vi.id_viaje ='$id'");
    }

    public function getAlojamiento($id_alojamiento){
        return $this->database->consulta("SELECT * 
                                              FROM alojamiento
                                              WHERE id_alojamiento = '$id_alojamiento';");

    }

    public function getResultadoChequeo($id_usuario){

       return $this->database->consulta("SELECT resultadoNivelVuelo FROM chequeo_medico cm
                                          INNER JOIN turno t
                                          ON cm.turno= t.id_turno
                                          WHERE t.usuario ='$id_usuario'");

    }

    public function getEmpresasTarjetas(){
        return $this->database->consulta("SELECT * FROM empresaTarjeta");
    }

    public function getRegistrarTarjeta($nroTarjeta, $titular , $vencimientoMes , $vencimientoAno, $nomTarjeta, $codSeguridad){
        return $this->database->ejecutar("INSERT INTO tarjeta_de_credito(nro_tarjeta, titular, vencimientoMes, vencimientoAno,nom_tarjeta,cod_seguridad)
                                          VALUES
                                          ('$nroTarjeta', '$titular' , '$vencimientoMes' , '$vencimientoAno', '$nomTarjeta', '$codSeguridad')");
    }

    public function getTarjeta($nroTarjeta){
      return $this->database->consulta("SELECT id_tarjeta FROM tarjeta_de_credito
                                        WHERE nro_tarjeta='$nroTarjeta'");
    }

    public function asignarTarjetaAUsuario($idTarjeta, $usuario){
      return $this->database->update("UPDATE usuario
                                      SET id_tarjeta='$idTarjeta'
                                      WHERE id_usuario='$usuario'");
    }

    public function asignarUsuarioReserva($idUsuario){
        return $this->database->ejecutar("INSERT INTO reserva(id_usuario)
                                              VALUES ('$idUsuario');");
    }

    public function reservarAlojamiento($idAlojamiento, $idUsuario){
        return $this->database->update("UPDATE reserva
                                            SET id_alojamiento = '$idAlojamiento',
                                                pagado = true
                                            WHERE id_usuario = '$idUsuario' AND id_reserva = (SELECT MAX(id_reserva) FROM reserva);");
    }

    public function alojamientoNoDisponible($idAlojamiento){
        return $this->database->update("UPDATE alojamiento
                                            SET disponible = FALSE
                                            WHERE id_alojamiento = '$idAlojamiento';");
    }

    public function getAsientosPorFila($viaje, $fila){
      return $this->database->consulta("SELECT
                                        a.id_asiento as 'idAsiento', 
                                        a.fila, 
                                        a.descripcion as 'asientos',
                                        a.disponible as 'asientoDisponible'
                                        FROM asiento a
                                        INNER JOIN vuelo v
                                        ON a.id_asiento = v.id_asiento
                                        INNER JOIN viaje vi
                                        ON v.id_viaje = vi.id_viaje
                                        INNER JOIN destino d
                                        ON d.id_destino = v.vuelo_destino
                                        WHERE d.descripcion='$viaje'
                                        AND a.fila='$fila'");
    }


    public function getAsientosPorFilaOrigenDestino($origen,$destino, $fila){
      return $this->database->consulta("SELECT
                                        a.id_asiento as 'idAsiento', 
                                        a.fila, 
                                        a.descripcion as 'asientos',
                                        a.disponible as 'asientoDisponible'
                                        FROM asiento a
                                        INNER JOIN vuelo v
                                        ON a.id_asiento = v.id_asiento
                                        INNER JOIN destino d
                                        ON d.id_destino = v.vuelo_destino
                                        WHERE v.vuelo_origen='$origen' and v.vuelo_destino='$destino'
                                        AND a.fila='$fila'");
    }

    public function asientoReservado($idAsiento){

      return $this->database->update("UPDATE asiento
                                      SET disponible = false
                                      WHERE id_asiento='$idAsiento'");

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

    public function getReservasViajes($id_usuario){
        return $this->database->consulta("SELECT *, DATE_FORMAT(f_partida, '%d/%m/%Y') AS 'fechaDeViaje', o.descripcion AS 'origen', d.descripcion AS 'destino',vi.pagado AS 'viaje_pagado', r.pagado AS 'reserva_pagado' , r.id_reserva as 'idreserva', r.id_viaje as idViaje
                                          FROM reserva r 
                                          inner join viaje vi on r.id_viaje = vi.id_viaje
                                          inner join vuelo vu on r.id_vuelo = vu.id_vuelo
                                          inner join origen o on vu.vuelo_origen = o.id_origen
                                          inner join destino d on vu.vuelo_destino = d.id_destino
                                          inner join tipo_viaje tv on vi.id_tipo_viaje = tv.id_tipo_viaje
                                          where r.id_usuario ='$id_usuario'
                                          group by vi.id_viaje");
    }

    public function getReservasAlojamientos($id_usuario){
        return $this->database->consulta("SELECT *
                                              FROM alojamiento
                                              INNER JOIN reserva
                                              ON alojamiento.id_alojamiento = reserva.id_alojamiento
                                              INNER JOIN destino
                                              ON alojamiento.id_destino  = destino.id_destino
                                              WHERE reserva.id_usuario = '$id_usuario';");
    }
  
    public function getAsiento($idAsiento){
      return $this->database->consulta("SELECT fila, descripcion FROM asiento
                                        WHERE id_asiento='$idAsiento'");
    }

    public function getUsuarioConReserva($usuario){
      return $this->database->consulta("SELECT distinct u.id_usuario 
                                        FROM usuario u
                                        inner join reserva r 
                                        on r.id_usuario = u.id_usuario
                                        WHERE u.id_usuario='$usuario'");
    }

    public function datosAlojamiento($idAlojamiento){
        return $this->database->consulta("SELECT *
                                              FROM alojamiento
                                              INNER JOIN destino
                                              ON alojamiento.id_destino = destino.id_destino
                                              WHERE id_alojamiento = '$idAlojamiento';");
    }


    public function cancelarReserva($reserva){

        return $this->database->update("DELETE FROM reserva
                                        WHERE id_reserva = '$reserva'");
    }

}
