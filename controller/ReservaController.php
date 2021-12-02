<?php

class ReservaController{

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

        if (isset($data["logueado"])) {

            $data['servicios'] = $this->reservaModel->servicios();
            $data['cabinas'] = $this->reservaModel->cabinas();
            $data['tipoVuelo'] = $this->reservaModel->getResultadoChequeo($_SESSION["id"]);
            $data['empresaTarjetas'] = $this->reservaModel->getEmpresasTarjetas();

            if(isset($_POST['idViaje']) && isset($_POST['destino'])
                && isset($_POST['horario']) && isset($_POST['fecha'])
                && isset($_POST['precio']) && isset($_POST['foto'])
                && isset($_POST['duracion']) && isset($_POST['vuelo']) ){

                $viaje=$_POST['idViaje'];
                $data['viaje'] = $this->reservaModel->getViaje($viaje);
                $data['filaA']=$this->reservaModel->getAsientosPorFila($_POST['destino'], 'A');
                $data['filaB']=$this->reservaModel->getAsientosPorFila($_POST['destino'], 'B');
                $data['filaC']=$this->reservaModel->getAsientosPorFila($_POST['destino'], 'C');
                $data['filaD']=$this->reservaModel->getAsientosPorFila($_POST['destino'], 'D');
                $data['destino'] = $_POST['destino'];
                $data['horario'] = $_POST['horario'];
                $data['fecha'] = $_POST['fecha'];
                $data['precio'] = $_POST['precio'];
                $data['foto'] = $_POST['foto'];
                $data['duracion'] = $_POST['duracion'];
                $data['vuelo'] = $_POST['vuelo'];
            }

            echo $this->render->renderizar("view/reservas.mustache", $data);

        }else{

            //echo $this->render->renderizar("view/login.mustache");

            header("Location:/GauchoRocket/login");
            exit();
        }
    }


    public function generarReserva(){
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

            $comprobanteReserva= substr(md5(uniqid(rand(),true)),0,8);
            $_SESSION['comprobante'] = $comprobanteReserva;
            $data['comprobante']=$comprobanteReserva;

            $usuario = $_SESSION["id"];
            $nombre = $_SESSION["nombre"];
            $apellido = $_SESSION["apellido"];

            $servicio = isset($_POST["servicio"]) ? $_POST["servicio"] : "";
            $cabina = isset($_POST["cabina"]) ? $_POST["cabina"] : "";
            $horaReserva = isset($_POST["horario"]) ? $_POST["horario"] : "";
            $id_vuelo = isset($_POST["vuelo"]) ? $_POST["vuelo"] : "";
            $asiento = isset($_POST["asiento"]) ? $_POST["asiento"] : "";
            $viaje = isset($_POST['viaje']) ? $_POST["viaje"]:"";

            $servicioEncontrado= $this->reservaModel->getServicio($servicio);
            $cabinaEncontrada = $this->reservaModel->getCabina($cabina);

            $_SESSION["servicio"] = $servicioEncontrado[0]['descripcion_tipo'];
            $_SESSION["cabina"] = $cabinaEncontrada[0]['tipo'];
            $_SESSION["viaje"] = $viaje;
            $_SESSION["horario"]=$horaReserva;
            $_SESSION["asiento"]=$asiento;
            $_SESSION["vuelo"]=$id_vuelo;

            $data['horaReserva'] = $horaReserva;
            $data['servicio'] = $servicioEncontrado[0]['descripcion_tipo'];
            $data['cabina'] = $cabinaEncontrada[0]['tipo'];
            $data['vuelo'] = $id_vuelo;
            $data['asiento']=$asiento;

            $this->reservaModel->asientoReservado($asiento);
            $this->reservaModel->registrarReserva($horaReserva,$id_vuelo,$servicioEncontrado[0]['id_tipo_servicio'] ,$cabinaEncontrada[0]['id_cabina'], $usuario, $viaje);

        }
        echo $this->render->renderizar("view/miReserva.mustache", $data);

    }

    public function sendMessageEmail($horaReserva, $cabina, $servicio, $vuelo, $comprobanteReserva){

        $nombre=$_SESSION['nombre'];
        $apellido=$_SESSION['apellido'];
        $email=$_SESSION['email'];


        $mailer =  $this->phpMailer->getMail();

        $mailer->AddEmbeddedImage('public/images/icon-email.png', 'logo');

        $message ="
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
                Para el vuelo con origen en: <strong>".$vuelo[0]['origen']."</strong>, destino a: <strong>".$vuelo[0]['destino']."</strong>, para el dia: <strong>".$vuelo[0]['fecha']."</strong> en el horario: <strong>".$vuelo[0]['hora']."</strong>, con asiento reservado en Fila: <strong>".$vuelo[0]['fila']."</strong>, asiento: <strong>".$vuelo[0]['asiento']."</strong>
               </p>
            </div>
        </div> ";

        return $this->phpMailer->send($email, "Reserva", $message);

    }


    public function crearPDF(){

        $nombre= $_SESSION["nombre"];
        $apellido= $_SESSION["apellido"];
        $horarioReserva= $_SESSION["horario"];
        $cabina=$_SESSION["cabina"];
        $servicio=$_SESSION["servicio"];
        $vuelo=$_SESSION["vuelo"];
        $comprobanteReserva = $_SESSION['comprobante'];
        $asiento = $_SESSION['asiento'];

        $vueloEncontrado= $this->reservaModel->getReservaVuelo($vuelo);
        $asientoEncontrado = $this->reservaModel->getAsiento($asiento);

        $this->sendMessageEmail($horarioReserva, $cabina, $servicio, $vueloEncontrado, $comprobanteReserva);

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
            Para el vuelo con origen en: <strong>".$vueloEncontrado[0]['origen']."</strong>, destino a: <strong>".$vueloEncontrado[0]['destino']."</strong>, para el dia: <strong>".$vueloEncontrado[0]['fecha']."</strong> en el horario: <strong>".$vueloEncontrado[0]['hora']."</strong>, con asiento reservado en Fila: <strong>".$asientoEncontrado[0]['fila']."</strong>, asiento: <strong>".$asientoEncontrado[0]['descripcion']."</strong><br>
         </div>";


        $data['pdf']=$this->pdf->createPDF($message,'reserva');



        if(isset($_SESSION['logueado'])){
            echo $this->render->renderizar("view/pdf.mustache");
        }
        else{
            header("Location: /GauchoRocket/login");
            exit();
        }

        echo $this->render->renderizar("view/pdf.mustache");

    }


    public function crearQr(){

        $nombre=$_SESSION['nombre'];
        $apellido=$_SESSION['apellido'];
        $cabina=$_SESSION["cabina"];
        $servicio=$_SESSION["servicio"];
        $vuelo=$_SESSION["vuelo"];
        $comprobanteReserva = $_SESSION['comprobante'];
        $vueloEncontrado= $this->reservaModel->getReservaVuelo($vuelo);

        $host = "http://".$_SERVER['HTTP_HOST'];

        $message ="
            COD COMPROBANTE DE RESERVA:".$comprobanteReserva."
            <br>  
            Reserva realizada por: ".$nombre." ".$apellido."
            <br>
            Con servicio:".$servicio.", Cabina: ".$cabina."  
            <br>
            Para el vuelo con origen en: ".$vueloEncontrado[0]['origen'].", destino a: ".$vueloEncontrado[0]['destino'].", para el dia: ".$vueloEncontrado[0]['fecha']." en el horario: ".$vueloEncontrado[0]['hora'].", con asiento reservado en Fila: ".$vueloEncontrado[0]['fila'].", asiento: ".$vueloEncontrado[0]['asiento'];

        $data['qr']= $this->qr->createQR($message);

        echo $this->render->renderizar("view/qr.mustache");
    }



    public function reservaCompleta(){
        $id_usuario = $_SESSION['id'];
        $reservaCompleta = $this->reservaModel->getReservas($id_usuario);
        $viajes = $_SESSION['viaje'];
        $data['viajes'] = $reservaCompleta;
        echo $this->render->renderizar("view/reservaCompleta.mustache",$data);
    }





}

