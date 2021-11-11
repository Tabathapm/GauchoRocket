<?php

class Configuracion{

    public static function getDatabase(){
        include_once("Database.php");
        $config = self::getConfigurationParameters();
        return new Database($config["servername"],$config["username"],$config["password"],$config["dbname"]);
    }

    private static function getConfigurationParameters(){
        return parse_ini_file("configuration/config.ini");
    }

    public static function getRender(){
        include("third-party/mustache/src/Mustache/Autoloader.php");
        include_once("Render.php");
        return new Render("view/partial");
    }
    public static function getGauchoRocketController(){
        $render = self:: getRender();
        include_once ("controller/GauchoRocketController.php");
        return new GauchoRocketController($render);
    }

    public static function getUsuarioModel(){
        $database = self::getDatabase();
        include_once ("model/UsuarioModel.php");
        return new UsuarioModel($database);
    }

    public static function getCentroMedicoModel(){
        $database = self::getDatabase();
        include_once ("model/CentroMedicoModel.php");
        return new CentroMedicoModel($database);
    }

    public static function getTurnoModel(){
        $database = self::getDatabase();
        include_once ("model/TurnoModel.php");
        return new TurnoModel($database);
    }

    public static function getReservaModel(){
        $database = self::getDatabase();
        include_once ("model/ReservaModel.php");
        return new ReservaModel($database);
    }


    public static function getLoginController(){
        $render = self::getRender();
        $usuarioModel = self::getUsuarioModel();
        include_once("controller/LoginController.php");
        return new LoginController($render,$usuarioModel);
    }

    public static function getLogoutController(){
        include_once ("controller/LogoutController.php");
        return new LogoutController();
    }

    public static function getHomeController(){
        $render = self::getRender();
        include_once("controller/HomeController.php");
        return new HomeController($render);
    }
    public static function getRegistrarseController(){
        $render = self::getRender();
        $usuarioModel = self::getUsuarioModel();
        include_once("controller/RegistrarseController.php");
        return new RegistrarseController($render,$usuarioModel);
    }

    public static function getCentroMedicoController(){
        $render = self::getRender();
        $centroMedicoModel = self::getCentroMedicoModel();
        include_once("controller/CentroMedicoController.php");
        return new CentroMedicoController($render, $centroMedicoModel);
    }

    public static function getTurnoController(){
        $render = self::getRender();
        $turnoModel = self::getTurnoModel();
        $phpMailer= self::getPHPMailer();
        include_once("controller/TurnoController.php");
        return new TurnoController($render, $turnoModel, $phpMailer);
    }

    public static function getReservaController(){
        $render = self::getRender();
        $reservaModel = self::getReservaModel();
        include_once("controller/ReservaController.php");
        return new ReservaController($render,$reservaModel);
    }


    public function getPHPMailer(){
        include_once("helpers/PHPMailerGmail.php");
        $email="gauchorocketsa@gmail.com";
        $pass="!:D!:)#2021pW2#TPLMJB!:)0f1g5d9g8e7m1";
        return new PHPMailerGmail($email, $pass);
    }

    public function getRouter(){
        include_once("Router.php");
        return new Router($this);
    }

    public function getUrlHelper(){
        include_once("helpers/UrlHelper.php");
        return new UrlHelper();
    }



    public static function getAlojamientoModel(){
        $database = self::getDatabase();
        include_once ("model/AlojamientoModel.php");
        return new AlojamientoModel($database);
    }

    public static function getAlojamientoController(){
        $render = self::getRender();
        $alojamientoModel = self::getAlojamientoModel();
        include_once ("controller/AlojamientoController.php");
        return new AlojamientoController($render,$alojamientoModel);
    }

    public static function getViajeModel(){
        $database = self::getDatabase();
        include_once ("model/ViajeModel.php");
        return new ViajeModel($database);
    }

    public static function getViajeController(){
        $render = self::getRender();
        $viajeModel = self::getViajeModel();
        include_once ("controller/ViajeController.php");
        return new ViajeController($render,$viajeModel);
    }


}