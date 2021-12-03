<?php

class ReservaModel
{
    private $database;
    public function __construct(\Database $database){
        $this->database=$database;
    }




    public function registrarReserva($hora_reserva,  $id_vuelo,$id_tipo_servicio, $id_cabina, $id_usuario,$idViaje){
        return $this->database->ejecutar("INSERT INTO reserva(      hora_reserva,id_vuelo,id_tipo_servicio,id_cabina, id_usuario,id_viaje)
                                           VALUES
                                          ('$hora_reserva','$id_vuelo','$id_tipo_servicio','$id_cabina','$id_usuario','$idViaje')");
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
        return $this->database->consulta("SELECT * FROM alojamiento");

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

    public function reservarAlojamiento($idAlojamiento, $idUsuario){
        return $this->database->update("UPDATE alojamiento 
                                            SET usuario = '$idUsuario',
                                            disponible = false
                                            WHERE idAlojamiento='$idAlojamiento';");
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

    public function asientoReservado($idAsiento){

      return $this->database->ejecutar("UPDATE asiento
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

    public function getReservas($id_usuario){
        $this->database->consulta("    select origen.descripcion as origen , destino.descripcion as destino, tipo_viaje.tipo as tipoViaje, viaje.f_partida as fecha, viaje.horario as horario, viaje.precio as precio from reserva 
                                            inner join alojamiento on reserva.id_alojamiento = alojamiento.id_alojamiento
                                            inner join viaje on reserva.id_viaje = viaje.id_viaje
                                            inner join vuelo on reserva.id_vuelo = vuelo.id_vuelo
                                            inner join origen on vuelo.vuelo_origen = origen.id_origen
                                            inner join destino on vuelo.vuelo_destino = destino.id_destino
                                            inner join tipo_viaje on viaje.id_tipo_viaje = tipo_viaje.id_tipo_viaje
                                            where reserva.id_usuario = '$id_usuario'");
    }

    public function getAsiento($idVuelo){

       $this->database->ejecutar("SELECT a.fila, a.descripcion 
                                  FROM asiento a inner join vuelo vu
                                  on vu.id_asiento = a.id_asiento
                                  WHERE vu.id_asiento='$idVuelo'"); 

    }

    

}
