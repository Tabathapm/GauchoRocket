<?php

class CentroMedicoModel
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


    public function updateTurno($idTurno, $idUsuario){
       return $this->database->update("UPDATE turno 
                                        SET usuario='$idUsuario',
                                            disponible=false
                                        WHERE id_turno='$idTurno'");
    }

   
}