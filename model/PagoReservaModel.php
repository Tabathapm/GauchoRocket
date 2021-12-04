<?php

class PagoReservaModel
{

    private $database;
    public function __construct(\Database $database){
        $this->database=$database;
    }

}