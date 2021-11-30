<?php

class CargarModel{
    private $database;

    public function __construct(\Database $database){
        $this->database = $database;
    }

    public function getTodosLosAlojamientos(){
        return $this->database->consulta("SELECT *
                                              FROM alojamiento
                                              INNER JOIN destino 
                                              ON alojamiento.id_destino = destino.id_destino");
    }

    public function getBorrarAlojamiento($id_alojamiento){
        return $this->database->ejecutar("DELETE FROM alojamiento
                                              WHERE id_alojamiento = '$id_alojamiento';");
    }

    public function getAlojamiento(){
        return $this->database->consulta("SELECT *
                                              FROM alojamiento
                                              GROUP BY nombreAlojamiento;");
    }
    public function getTodosLosDestinos(){
        return $this->database->consulta("SELECT descripcion, id_destino
                                              FROM destino
                                              GROUP BY descripcion;");
    }

    public function getCargarAlojamientos($habitaciones, $destino, $alojamiento, $precio){
        return $this->database->ejecutar("INSERT INTO alojamiento(cant_habitaciones,id_destino,nombreAlojamiento,precio, disponible)
                                              VALUES ('$habitaciones', '$destino', '$alojamiento', '$precio', true);");
    }

}