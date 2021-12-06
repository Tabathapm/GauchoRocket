<?php

class PagoReservaViajeController{
    private $render;
    private $pagoReservaViajeModel;
    private $pdf;
    private $qr;
    private $phpMailer;

    public function __construct(\Render $render, \PagoReservaViajeModel $pagoReservaViajeModel, \PDF $pdf, \QR $qr, \PHPMailerGmail $phpMailer){
        $this->render = $render;
        $this->pagoReservaViajeModel = $pagoReservaViajeModel;
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

            $data['empresaTarjetas'] = $this->pagoReservaViajeModel->getEmpresasTarjetas();

            if (isset($_POST["idReserva"])) {
                $_SESSION["idReserva"] = $_POST["idReserva"];
            }

            echo $this->render->renderizar("view/PagoReservaViaje.mustache", $data);

        }else {
            header("Location:/GauchoRocket/login");
            exit();
        }
    }

    public function pagar(){
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
            if (isset($_POST["empresaTarjeta"]) && isset($_POST["nroTarjeta"]) && isset($_POST["nombreTitular"])
                && isset($_POST["mesVencimiento"]) && isset($_POST["anioVencimiento"]) && isset($_POST["codSeguridad"])
                && isset($_SESSION["idReserva"])) {

                $idReserva = $_SESSION["idReserva"];
                $tarjeta = $_POST["empresaTarjeta"];
                $nroTarjeta = $_POST['nroTarjeta'];
                $nombreTitular = $_POST['nombreTitular'];
                $mesVencimiento = $_POST['mesVencimiento'];
                $anioVencimiento = $_POST['anioVencimiento'];
                $codSeguridad = $_POST['codSeguridad'];

                $data['id_reserva'] = $idReserva;

                if (isset($_SESSION['comprobante'])) {

                    $comprobante = $_SESSION['comprobante'];

                    if (isset($_SESSION["horaReserva"]) && isset($_SESSION["cabina"]) && isset($_SESSION["fila"])
                        && isset($_SESSION["asiento"]) && isset($_SESSION["servicio"]) && isset($_SESSION["vuelo"])) {

                        $horaReserva = $_SESSION["horaReserva"];
                        $cabina = $_SESSION["cabina"];
                        $fila = $_SESSION["fila"];
                        $asiento = $_SESSION["asiento"];
                        $servicio = $_SESSION["servicio"];
                        $vuelo = $_SESSION["vuelo"];

                        if ($this->pagoReservaViajeModel->getRegistrarTarjeta($nroTarjeta, $nombreTitular, $mesVencimiento,
                                $anioVencimiento, $tarjeta, $codSeguridad) && $this->pagoReservaViajeModel->actualizarReserva($idReserva)) {

                            $this->sendMessageEmail($horaReserva, $cabina, $fila, $asiento, $servicio, $vuelo, $comprobante);
                            $data["pagado"] = true;

                        } else {

                            $data["pagado"] = false;

                        }
                    }
                }

                echo $this->render->renderizar("view/confirmacionPagoViaje.mustache", $data);
            }
        }
    }

    public function sendMessageEmail($horaReserva, $cabina, $fila, $asiento, $servicio, $vuelo, $comprobanteReserva){

        $nombre = $_SESSION['nombre'];
        $apellido = $_SESSION['apellido'];
        $email = $_SESSION['email'];

        $mailer =  $this->phpMailer->getMail();

        $mailer->AddEmbeddedImage('public/images/icon-email.png', 'logo');

        $message = "
        <div>
            <div style='display:flex; flex-direction:row;'>
                <span>
                    <img src='cid:logo' width=40>
                </span>
                <h1>Gaucho Rocket</h1>
            </div>
            <div>
               <p>
               <strong>COD COMPROBANTE DE RESERVA: </strong><span>".$comprobanteReserva."</span>
                <br>  
                Reserva realizada por: ".$nombre." ".$apellido."
                <br>
                Con servicio: <strong>".$servicio."</strong>, Cabina: <strong>".$cabina."</strong>  
                <br>
                Para el vuelo con origen en: <strong>".$vuelo[0]['origen']."</strong>, destino a: <strong>".$vuelo[0]['destino']."</strong>, para el dia: <strong>".$vuelo[0]['fecha']."</strong> en el horario: <strong>".$vuelo[0]['hora']."</strong>, con asiento reservado en Fila: <strong>".$fila."</strong>, asiento: <strong>".$asiento."</strong>
               </p>
            </div>
        </div> ";

        return $this->phpMailer->send($email, "Reserva", $message);

    }


    public function crearPDF(){

        $nombre= $_SESSION["nombre"];
        $apellido= $_SESSION["apellido"];

        $reserva = isset($_SESSION["idReserva"]) ? $_SESSION["idReserva"] : "";

        $reservaEncontrada = $this->pagoReservaViajeModel->getReserva($reserva);
        $vueloEncontrado= $this->pagoReservaViajeModel->getReservaVuelo($reservaEncontrada[0]['vuelo']);

        $horarioReserva= $reservaEncontrada[0]['hora'];
        $cabina=$reservaEncontrada[0]['cabina'];
        $servicio=$reservaEncontrada[0]['servicio'];
        $comprobanteReserva = $_SESSION['comprobante'];
        $fila = $reservaEncontrada[0]['fila'];
        $asiento = $reservaEncontrada[0]['asiento'];

        $host = "http://".$_SERVER['HTTP_HOST'];

        $message ="
         <div>
            <img src='$host/GauchoRocket/public/images/marca-pdf.png' style='width:60rem;'/>
            <strong>COD COMPROBANTE DE RESERVA: </strong><span>".$comprobanteReserva."</span>
            <br>
            Reserva realizada por: ".$nombre." ".$apellido."
            <br>
            Con servicio: <strong>".$servicio."</strong>, Cabina: <strong>".$cabina."</strong>
            <br>
            Para el vuelo con origen en: <strong>".$vueloEncontrado[0]['origen']."</strong>, destino a: <strong>".$vueloEncontrado[0]['destino']."</strong>, para el dia: <strong>".$vueloEncontrado[0]['fecha']."</strong> en el horario: <strong>".$vueloEncontrado[0]['hora']."</strong>, con asiento reservado en Fila: <strong>".$fila."</strong>, asiento: <strong>".$asiento."</strong><br>
         </div>";


        $data['pdf']=$this->pdf->createPDF($message,'reserva');


        if(isset($_SESSION['logueado'])){
            echo $this->render->renderizar("view/pdf.mustache");
        }
        else{
            header("Location: /GauchoRocket/login");
            exit();
        }

        echo $this->render->renderizar("view/pdf.mustache", $data);

    }


    public function crearQr(){

        $nombre=$_SESSION['nombre'];
        $apellido=$_SESSION['apellido'];

        $reserva = isset($_SESSION["idReserva"]) ? $_SESSION["idReserva"] : "";

        $reservaEncontrada = $this->pagoReservaViajeModel->getReserva($reserva);
        $vueloEncontrado= $this->pagoReservaViajeModel->getReservaVuelo($reservaEncontrada[0]['vuelo']);

        $cabina=$reservaEncontrada[0]['cabina'];
        $servicio=$reservaEncontrada[0]['servicio'];
        $comprobanteReserva = $_SESSION['comprobante'];
        $fila = $reservaEncontrada[0]['fila'];
        $asiento = $reservaEncontrada[0]['asiento'];


        $host = "http://".$_SERVER['HTTP_HOST'];

        $message = "
            COD COMPROBANTE DE RESERVA:".$comprobanteReserva."
            <br>  
            Reserva realizada por: ".$nombre." ".$apellido."
            <br>
            Con servicio:".$servicio.", Cabina: ".$cabina."  
            <br>
            Para el vuelo con origen en: ".$vueloEncontrado[0]['origen'].", destino a: ".$vueloEncontrado[0]['destino'].", para el dia: ".$vueloEncontrado[0]['fecha']." en el horario: ".$vueloEncontrado[0]['hora'].", con asiento reservado en Fila: ".$fila.", asiento: ".$asiento;

        $data['qr']= $this->qr->createQR($message);

        echo $this->render->renderizar("view/qr.mustache");
    }


}