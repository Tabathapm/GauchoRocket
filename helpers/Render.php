<?php


class Render{

    private $mustache;

    public function __construct ($partialsPathLoader){
        Mustache_Autoloader::register();
        $this->mustache = new Mustache_Engine
        (
            array(
                'partials_loader' => new Mustache_Loader_FilesystemLoader($partialsPathLoader),
//                'helpers' => array('_SESSION' => $_SESSION)
            )
        );
    }

    public function renderizar($vista, $datos = []){
        $contenidoString = file_get_contents($vista);
        return $this->mustache->render($contenidoString,$datos);
    }
}