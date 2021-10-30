<?php

class LoginController{

    private $render;
    private $usuarioModel;

    public function __construct(\Render $render, \UsuarioModel $usuarioModel){
        $this->render = $render;
        $this->usuarioModel = $usuarioModel;
    }

    public function execute(){
        echo $this->render->renderizar("view/login.mustache");
    }

    public function validarLogin(){
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $email = $_POST["email"];
            $pass = md5($_POST["password"]);

            $user = $this->usuarioModel->getUsuarioByEmailPassword($email,$pass);

            if(empty($user)){
                header("Location: /GauchoRocket/");
                exit();
            }
            elseif($this->usuarioModel->getUsuarioSiExisteMail($email) < 0) {
                header("Location: /GauchoRocket/");
                exit();
            } else  {
                header("Location: /GauchoRocket/home");
                exit();
            }
        }
    }

}