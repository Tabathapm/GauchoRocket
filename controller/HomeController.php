<?php

class HomeController{

    private $render;

    public function __construct(\Render $render){
        $this->render = $render;
    }

    public function execute(){
        $data = array();

        if (isset($_SESSION["logueado"])) {
            $data["logueado"] = $_SESSION["logueado"];
        }

        if (isset($_SESSION["nombre"])) {
            $data["nombre"] = $_SESSION["nombre"];
        }

        if (isset($_SESSION["esAdmin"])) {
            $data["esAdmin"] = $_SESSION["esAdmin"];
        }

        if (isset($_SESSION["esClient"])) {
            $data["esClient"] = $_SESSION["esClient"];
        }

        if (isset($data["logueado"])) {
            echo $this->render->renderizar("view/home.mustache", $data);
        } else {
            echo $this->render->renderizar("view/gauchoRocket.mustache");
        }
    }
}
