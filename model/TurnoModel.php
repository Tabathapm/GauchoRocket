<?php

class TurnoModel
{
    private $database;

    public function __construct(\Database $database){
        $this->database = $database;
    }


    public function getCentrosMedico(){
       return $this->database->consulta("SELECT * FROM centro_medico");
    }


    public function getTurnosCentroMedico($centroMedico){
        return $this->database->consulta("SELECT * FROM turno t
                                          INNER JOIN centro_medico cm
                                          ON cm.id_centro_medico= t.id_centro_medico
                                          WHERE nom_centro_medico='$centroMedico'");
    }

    public function getCentroMedicoPorTurno($idTurno){
        return $this->database->consulta("SELECT * FROM centro_medico cm
                                          INNER JOIN turno t
                                          ON cm.id_centro_medico= t.id_centro_medico
                                          WHERE t.id_turno='$idTurno'");
    }


    public function getTurno($idTurno){
        return $this->database->consulta("SELECT * FROM turno t
                                          WHERE t.id_turno='$idTurno'");
    }

    public function getUsuarioPorTurno($usuario, $idTurno){
        return $this->database->consulta("SELECT * FROM usuario u 
                                          INNER JOIN turno t
                                          ON t.usuario= u.id_usuario
                                          WHERE t.usuario='$usuario'
                                          and t.id_turno='$idTurno'");
    }


    public function updateTurno($idTurno, $idUsuario){
       return $this->database->update("UPDATE turno 
                                        SET usuario='$idUsuario',
                                            disponible=false
                                        WHERE id_turno='$idTurno'");
    }

    public function cargarCheckeo($resultado, $centroMedico, $turno){
        return $this->database->ejecutar("INSERT INTO chequeo_medico(resultado, id_centro_medico, turno)
                                          VALUES('$resultado','$centroMedico','$turno')");
    }

   
}