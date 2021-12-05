<?php

class PagoReservaController{
    private $render;
    private $pagoReservaModel;
    private $pdf;
    private $qr;
    private $phpMailer;

    public function __construct(\Render $render, \PagoReservaModel $pagoReservaModel, \PDF $pdf, \QR $qr, \PHPMailerGmail $phpMailer){
        $this->render = $render;
        $this->pagoReservaModel = $pagoReservaModel;
        $this->pdf=$pdf;
        $this->qr=$qr;
        $this->phpMailer = $phpMailer;
    }

    public function execute(){

        $data = array();

        if (isset($_SESSION["logueado"])) {
            $data["logueado"] = $_SESSION["logueado"];
        }

        if (isset($_SESSION["id"])) {
            $data["id"] = $_SESSION["id"];
        }

        if (isset($_SESSION["nombre"])) {
            $data["nombre"] = $_SESSION["nombre"];
        }

        if (isset($_SESSION["apellido"])) {
            $data["apellido"] = $_SESSION["apellido"];
        }

        if (isset($_SESSION["esAdmin"])) {
            $data["esAdmin"] = $_SESSION["esAdmin"];
        }

        if (isset($_SESSION["esClient"])) {
            $data["esClient"] = $_SESSION["esClient"];
        }

        if(isset($_SESSION["mensajeDePago"])){
            $data["mensajeDePago"] = $_SESSION["mensajeDePago"];
            unset($_SESSION["mensajeDePago"]);
        }

        if(isset($_SESSION["mensajeDePagoError"])){
            $data["mensajeDePagoError"] = $_SESSION["mensajeDePagoError"];
            unset($_SESSION["mensajeDePagoError"]);
        }

        if (isset($data["logueado"])) {

            $data['empresaTarjetas'] = $this->pagoReservaModel->getEmpresasTarjetas();

            if (isset($_POST["idReserva"])) {
                $_SESSION["idReserva"] = $_POST["idReserva"];
            }

            echo $this->render->renderizar("view/PagoReserva.mustache", $data);

        }else {
            header("Location:/GauchoRocket/login");
            exit();
        }
    }

    public function pagar(){
        if (isset($_POST["empresaTarjeta"]) && isset($_POST["nroTarjeta"]) && isset($_POST["nombreTitular"])
            && isset($_POST["mesVencimiento"]) && isset($_POST["anioVencimiento"]) && isset($_POST["codSeguridad"])
            && isset($_SESSION["idReserva"])){

            $idReserva = $_SESSION["idReserva"];
            $tarjeta = $_POST["empresaTarjeta"];
            $nroTarjeta = $_POST['nroTarjeta'];
            $nombreTitular = $_POST['nombreTitular'];
            $mesVencimiento = $_POST['mesVencimiento'];
            $anioVencimiento = $_POST['anioVencimiento'];
            $codSeguridad = $_POST['codSeguridad'];

                $this->pagoReservaModel->getRegistrarTarjeta($nroTarjeta, $nombreTitular, $mesVencimiento,
                    $anioVencimiento, $tarjeta, $codSeguridad);

                $this->pagoReservaModel->actualizarReserva($idReserva);

                $_SESSION["mensajeDePago"] = "Pago exitoso!";


        }

        header("Location: /GauchoRocket/PagoReserva");
        exit();
    }
}