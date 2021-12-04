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
        $model = self::getHomeModel();
        include_once ("controller/GauchoRocketController.php");
        return new GauchoRocketController($render, $model);
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

    public static function getPagoReservaModel(){
        $database = self::getDatabase();
        include_once ("model/PagoReservaModel.php");
        return new PagoReservaModel($database);
    }

    public static function getPagoReservaController(){
        $pdf = self::getPDF();
        $render = self::getRender();
        $reservaModel = self::getReservaModel();
        $qr = self::getQR();
        $phpMailer = self::getPHPMailer();
        include_once("controller/PagoReservaController.php");
        return new PagoReservaController($render,$reservaModel, $pdf,$qr, $phpMailer);
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
        $homeModel = self::getHomeModel();
        include_once("controller/HomeController.php");
        return new HomeController($render,$homeModel);

    }
    public static function getRegistrarseController(){
        $render = self::getRender();
        $usuarioModel = self::getUsuarioModel();
        $phpMailer= self::getPHPMailer();
        include_once("controller/RegistrarseController.php");
        return new RegistrarseController($render,$usuarioModel, $phpMailer);
    }

    public static function getValidacionController(){
        $render = self::getRender();
        $usuarioModel = self::getUsuarioModel();
        include_once("controller/ValidacionController.php");
        return new ValidacionController($render, $usuarioModel);
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
        $pdf = self::getPDF();
        $render = self::getRender();
        $reservaModel = self::getReservaModel();
        $qr = self::getQR();
        $phpMailer = self::getPHPMailer();
        include_once("controller/ReservaController.php");
        return new ReservaController($render,$reservaModel, $pdf,$qr, $phpMailer);
    }

    public static function getPHPMailer(){
        include_once("helpers/PHPMailerGmail.php");
        $email="gauchorocketsa@gmail.com";
        $pass="!:D!:)#2021pW2#TPLMJB!:)0f1g5d9g8e7m1";
        return new PHPMailerGmail($email, $pass);
    }

    public static function getPDF(){
        include_once("helpers/PDF.php");
        return new PDF();
    }

    public static function getQR(){
        include_once("helpers/QR.php");
        return new QR();
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


    public static function getHomeModel(){
        $database = self::getDatabase();
        include_once("model/HomeModel.php");
        return new HomeModel($database);
    }

    public static function getViajeModel(){
        $database = self::getDatabase();
        include_once ("model/ViajeModel.php");
        return new ViajeModel($database);
    }

    public static function getViajeController(){
        $render = self::getRender();
        $viajeModel = self::getViajeModel();
        $phpMailer= self::getPHPMailer();
        include_once ("controller/ViajeController.php");
        return new ViajeController($render,$viajeModel, $phpMailer);
    }

    public static function getReportesModel(){
        $database = self::getDatabase();
        include_once ("model/ReportesModel.php");
        return new ReportesModel($database);
    }

    public static function getReportesController(){
        $render = self::getRender();
        $reportesModel = self::getReportesModel();
        $pdf = self::getPDF();
        include_once ("controller/ReportesController.php");
        return new ReportesController($render, $reportesModel, $pdf);
    }

    public static function getCargarAlojamientosModel(){
        $database = self::getDatabase();
        include_once("model/CargarAlojamientosModel.php");
        return new CargarAlojamientosModel($database);
    }

    public static function getCargarAlojamientosController(){
        $render = self::getRender();
        $cargasModel = self::getCargarAlojamientosModel();
        include_once("controller/CargarAlojamientosController.php");
        return new CargarAlojamientosController($render, $cargasModel);
    }

    public static function getCargarViajesModel(){
        $database = self::getDatabase();
        include_once("model/CargarViajesModel.php");
        return new CargarViajesModel($database);
    }

    public static function getCargarViajesController(){
        $render = self::getRender();
        $cargasModel = self::getCargarViajesModel();
        include_once("controller/CargarViajesController.php");
        return new CargarViajesController($render, $cargasModel);
    }

}