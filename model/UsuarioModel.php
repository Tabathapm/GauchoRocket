<?php

class UsuarioModel
{
    private $database;

    public function __construct(\Database $database){
        $this->database = $database;
    }

//  SE TIRAN TODAS LAS CONSULTAS QUE PODEMOS HACER DESDE LA BASE DE DATOS

    public function getUsuarioByEmailPassword($email,$password){
        return $this->database->consulta("SELECT md5('$password'), email, rol_usuario, nombre_usuario, id_usuario, apellido_usuario 
                                              FROM usuario 
                                              WHERE email = '$email' AND activo = 1");
    }

    public function registrarUsuario($nombre, $apellido, $email, $password, $hash){
        return $this->database->ejecutar("INSERT INTO usuario(nombre_usuario, apellido_usuario, email, clave, hash) 
                                              VALUES ('$nombre', '$apellido', '$email', '$password', '$hash')");
    }

    public function getUsuarioSiExisteMail($email){
        return $this->database->consulta("SELECT * FROM usuario WHERE email ='$email'");
    }

    public function getNombre($email){
        return $this->database->consulta("SELECT nombre_usuario FROM usuario WHERE email = '$email'");
    }

    public function buscar($email, $hash){
        return $this->database->consulta("SELECT email, hash, activo FROM usuario WHERE email = '$email' AND hash = '$hash' AND activo = 0");
    }

    public function activar($email, $hash){
        return $this->database->update("UPDATE usuario SET activo = 1 WHERE email= '$email' AND hash = '$hash' AND activo = 0");
    }
}