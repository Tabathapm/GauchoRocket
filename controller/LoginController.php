<?php

class LoginController{

    private $render;
    private $usuarioModel;
    public function __construct(\Render $render, \UsuarioModel $usuarioModel)
    {
        $this->render = $render;
        $this->usuarioModel = $usuarioModel;
    }

    public function execute(){
        $data = array();

        if (isset($_SESSION["errorLogin"]) && $_SESSION["errorLogin"] == 1) {
            $data["MensajeErrorLogin"] = "E-Mail o contraseña incorrecta";
            unset($_SESSION["errorLogin"]);
        }

        if(isset($_SESSION['registroCorrecto']) && $_SESSION['registroCorrecto'] === 1){
            $data['registroCorrecto'] = "Se ha registrado correctamente.";
            unset($_SESSION['registroCorrecto']);
        }

        if(isset($_SESSION['registroIncorrecto']) && $_SESSION['registroIncorrecto'] === 1){
            $data['registroIncorrecto'] = "Hubo un problema, intente nuevamente.";
            unset($_SESSION['registroIncorrecto']);
        }

        if(isset($_SESSION['clavesIncorrectas']) && $_SESSION['clavesIncorrectas'] === 1){
            $data['clavesIncorrectas'] = "Las claves no coinciden.";
            unset($_SESSION['clavesIncorrectas']);
        }

        if(isset($_SESSION['emailExistente']) && $_SESSION['emailExistente'] === 1){
            $data['emailExistente'] = "Ya posee una cuenta con ese Email.";
            unset($_SESSION['emailExistente']);
        }

        echo $this->render->renderizar("view/login.mustache",$data);
    }

    public function validarLogin(){
        if (isset($_POST['ingreso'])){
            if (isset($_POST["email"]) && isset($_POST["clave"])) {
                $email = $_POST["email"];
                $password = md5($_POST["clave"]);

                $user = $this->usuarioModel->getUsuarioByEmailPassword($email,$password);

                if(empty($user)){
                    $_SESSION["errorLogin"] = 1;
                    header("Location: /GauchoRocket/");
                    exit();
                } else {
//                    header("Location: /GauchoRocket/home");
//                    exit();
                    echo $this->render->renderizar("view/home.mustache");
                }
            }
        }
    }


}