<?php

class RegistrarseController{

    private $render;
    private $usuarioModel;

    public function __construct(\Render $render, \UsuarioModel $usuarioModel){
        $this->render = $render;
        $this->usuarioModel = $usuarioModel;
    }

    public function execute(){
        echo $this->render->renderizar("view/registrarse.mustache");
    }

    public function validarRegistro(){
        if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['clave']) && isset($_POST['clave-repetida'])){
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $pass = $_POST['clave'];
            $repass = $_POST['clave-repetida'];

            if ($pass === $repass){
                if(!$this->usuarioModel->getUsuarioSiExisteMail($email)){
                    $password = md5($pass);
                    $this->usuarioModel->registrarUsuario($nombre,$apellido,$email,$password);
                    $_SESSION['registroCorrecto'] = 1;
                    header("Location: /GauchoRocket/login");
                }else{
                    $_SESSION['emailExistente'] = 1;
                    header("Location: /GauchoRocket/");
                }
            }else{
                $_SESSION['clavesIncorrectas'] = 1;
                header("Location: /GauchoRocket/");
            }
        }else{
            $_SESSION['registroIncorrecto'] = 1;
            header("Location: /GauchoRocket/");
        }
    }
}