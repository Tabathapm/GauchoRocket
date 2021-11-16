<?php

class ValidacionController{

    private $render;
    private $usuarioModel;

    public function __construct(\Render $render,  \UsuarioModel $usuarioModel){
        $this->render = $render;
        $this->usuarioModel = $usuarioModel;
    }

    public function execute(){
        $data = array();

        if($_GET["email"] && !empty($_GET["email"]) && $_GET["hash"] && !empty($_GET["hash"])  ){
            $hash = $_GET["hash"];
            $email = $_GET["email"];

            $buscar = $this->usuarioModel->buscar($email, $hash);

            if ($buscar > 0){
                $activar = $this->usuarioModel->activar($email, $hash);

                $data["MensajeActivo"] = "Validación correcta, ya puede iniciar sesión";

                echo $this->render->renderizar("view/login.mustache", $data);
            }

        }
    }


}