<?php

class HomeController{

    private $render;

    public function __construct(\Render $render){
        $this->render = $render;
    }

    public function execute(){
        if (isset($_SESSION["logueado"])) {
            echo $this->render->renderizar("view/home.mustache");
        } else {
            header("location: /GauchoRocket/");
            exit();
        }
    }
}