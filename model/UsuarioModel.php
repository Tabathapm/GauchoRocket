<?php

class UsuarioModel
{
    private $database;

    public function __construct(\Database $database){
        $this->database = $database;
    }

//  SE TIRAN TODAS LAS CONSULTAS QUE PODEMOS HACER DESDE LA BASE DE DATOS

    public function getUsuarioByEmailPassword($email,$password){
        return $this->database->consulta("SELECT md5('$password'), email FROM usuario WHERE email = '$email'");
    }

    public function registrarUsuario($nombre, $apellido, $email, $password){
        return $this->database->ejecutar("INSERT INTO usuario(nombre_usuario, apellido_usuario, email, clave) 
                                              VALUES ('$nombre', '$apellido', '$email', '$password')");
    }

    public function getUsuarioSiExisteMail($email){
        return $this->database->consulta("SELECT * FROM usuario WHERE email ='$email'");
    }

    public function getNombre($email){
        return $this->database->consulta("SELECT nombre_usuario FROM usuario WHERE email = '$email'");
    }
}