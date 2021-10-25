<?php

class HomeController{

    private $render;

    public function __construct(\Render $render){
        $this->render = $render;
    }

    public function execute(){

        echo $this->render->renderizar("view/home.mustache");
    }
}