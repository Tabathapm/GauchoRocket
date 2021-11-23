<?php

class ReservaModel
{
    private $database;
    public function __construct(\Database $database){
        $this->database=$database;
    }




    public function registrarReserva($hora_reserva, $id_tarjeta, $id_vuelo,$id_tipo_servicio, $id_cabina, $id_usuario){
        return $this->database->ejecutar("INSERT INTO reserva(      hora_reserva,id_tarjeta,id_vuelo,id_tipo_servicio,id_cabina, id_usuario)
                                           VALUES
                                          ('$hora_reserva','$id_tarjeta','$id_vuelo','$id_tipo_servicio','$id_cabina','$id_usuario')");
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

    public function getResultadoChequeo($id_usuario){

        return $this->database->consulta("SELECT resultado FROM chequeo_medico cm
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



    

}
