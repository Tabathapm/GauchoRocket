<?php

class LoginController{

    private $render;
    private $usuarioModel;

    public function __construct(\Render $render, \UsuarioModel $usuarioModel){
        $this->render = $render;
        $this->usuarioModel = $usuarioModel;
    }

    public function execute(){
        $data = array();

        if (isset($_SESSION["errorLogin"]) && $_SESSION["errorLogin"] == 1) {
            $data["MensajeErrorLogin"] = "E-Mail o contraseña incorrecta";
            unset($_SESSION["errorLogin"]);
        }

        echo $this->render->renderizar("view/login.mustache", $data);
    }

    public function validarLogin(){
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $email = $_POST["email"];
            $pass = md5($_POST["password"]);

            $user = $this->usuarioModel->getUsuarioByEmailPassword($email,$pass);

            if(!empty($user)){
                $_SESSION["logueado"] = 0;
                $_SESSION["usuario_completo"] = $user[0];
                $_SESSION["id"] = $user[0]["id_usuario"];
                $_SESSION["nombre"] = $user[0]["nombre_usuario"];
                $_SESSION["apellido"] = $user[0]["apellido_usuario"];
                $_SESSION["email"] = $user[0]["email"];
                $_SESSION["esAdmin"] = $this->esAdmin($user[0]["rol_usuario"]);
                $_SESSION["esClient"] = $this->esCliente($user[0]["rol_usuario"]);
                header("Location: /GauchoRocket/home");
                exit();
            } else  {
                $_SESSION["errorLogin"] = 1;
                header("Location: /GauchoRocket/login");
                exit();
            }
        }
    }

    public function esAdmin($rol){
        return  $rol == "ADMIN" ? true : false;
    }

    public function esCliente($rol){
        return  $rol == null ? true : false;
    }

}

