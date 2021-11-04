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

}