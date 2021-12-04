<?php

class PagoReservaController{
    private $render;
    private $reservaModel;
    private $pdf;
    private $qr;
    private $phpMailer;

    public function __construct(\Render $render, \ReservaModel $reservaModel, \PDF $pdf, \QR $qr, \PHPMailerGmail $phpMailer){
        $this->render = $render;
        $this->reservaModel = $reservaModel;
        $this->pdf=$pdf;
        $this->qr=$qr;
        $this->phpMailer = $phpMailer;
    }

    public function execute()
    {

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

        if (isset($data["logueado"])) {

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

            if (isset($data["logueado"])) {

                $nroTarjeta = $_POST['nroTarjeta'];
                $nombreTitular = $_POST['nombreTitular'];
                $mesVencimiento = $_POST['mesVencimiento'];
                $anoVencimiento = $_POST['anoVencimiento'];
                $codSeguridad = $_POST['codSeguridad'];

                $data['nroTarjeta'] = $nroTarjeta;
                $data['nombreTitular'] = $nombreTitular;
                $data['mesVencimiento'] = $mesVencimiento;
                $data['anoVencimiento'] = $anoVencimiento;
                $data['codSeguridad'] = $codSeguridad;

                echo $this->render->renderizar("view/PagoReserva.mustache", $data);


//            $data['servicios'] = $this->reservaModel->servicios();
//            $data['cabinas'] = $this->reservaModel->cabinas();
//            $data['tipoVuelo'] = $this->reservaModel->getResultadoChequeo($_SESSION["id"]);
//            $data['empresaTarjetas'] = $this->reservaModel->getEmpresasTarjetas();
//
//            if(isset($_POST['idViaje']) && isset($_POST['destino'])
//                && isset($_POST['horario']) && isset($_POST['fecha'])
//                && isset($_POST['precio']) && isset($_POST['foto'])
//                && isset($_POST['duracion']) && isset($_POST['vuelo']) ){
//
//                $viaje=$_POST['idViaje'];
//                $data['viaje'] = $this->reservaModel->getViaje($viaje);
//                $data['filaA']=$this->reservaModel->getAsientosPorFila($_POST['destino'], 'A');
//                $data['filaB']=$this->reservaModel->getAsientosPorFila($_POST['destino'], 'B');
//                $data['filaC']=$this->reservaModel->getAsientosPorFila($_POST['destino'], 'C');
//                $data['filaD']=$this->reservaModel->getAsientosPorFila($_POST['destino'], 'D');
//                $data['destino'] = $_POST['destino'];
//                $data['horario'] = $_POST['horario'];
//                $data['fecha'] = $_POST['fecha'];
//                $data['precio'] = $_POST['precio'];
//                $data['foto'] = $_POST['foto'];
//                $data['duracion'] = $_POST['duracion'];
//                $data['vuelo'] = $_POST['vuelo'];
//                $data['viaje'] = $_POST['idViaje'];
//            }
//
//            echo $this->render->renderizar("view/PagoReserva.mustache", $data);

            } else {


                header("Location:/GauchoRocket/login");
                exit();
            }
        }


    }
}