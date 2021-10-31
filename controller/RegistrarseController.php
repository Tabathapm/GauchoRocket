<?php

class RegistrarseController{

    private $render;
    private $usuarioModel;

    public function __construct(\Render $render, \UsuarioModel $usuarioModel){
        $this->render = $render;
        $this->usuarioModel = $usuarioModel;
    }

    public function execute(){
        $data = array();

        if(isset($_SESSION['registroCorrecto']) && $_SESSION['registroCorrecto'] === 1){
            $data['registroCorrecto'] = "Se ha registrado correctamente. El Administrador activará su cuenta pronto.";
            unset($_SESSION['registroCorrecto']);
        }

        if(isset($_SESSION['registroIncorrecto']) && $_SESSION['registroIncorrecto'] === 1){
            $data['registroIncorrecto'] = "Hubo un problema, intente nuevamente.";
            unset($_SESSION['registroIncorrecto']);
        }
        if(isset($_SESSION['emailExistente']) && $_SESSION['emailExistente'] === 1){
            $data['emailExistente'] = "Ya posee una cuenta con ese Email. Contacte un Administrador para ser habilitado.";
            unset($_SESSION['emailExistente']);
        }
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
                    exit();
                }else{
                    $_SESSION['emailExistente'] = 1;
                    header("Location: /GauchoRocket/");
                    exit();
                }
            }else{
                $_SESSION['clavesIncorrectas'] = 1;
                header("Location: /GauchoRocket/");
                exit();
            }
        }else{
            $_SESSION['registroIncorrecto'] = 1;
            header("Location: /GauchoRocket/");
            exit();
        }
    }
}