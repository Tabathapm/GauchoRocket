<?php

class PagoReservaAlojamientoController{
    private $render;
    private $pagoReservaAlojamientoModel;
    private $pdf;
    private $qr;
    private $phpMailer;

    public function __construct(\Render $render, \PagoReservaAlojamientoModel $pagoReservaAlojamientoModel, \PDF $pdf, \QR $qr, \PHPMailerGmail $phpMailer){
        $this->render = $render;
        $this->pagoReservaAlojamientoModel = $pagoReservaAlojamientoModel;
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

            $data['empresaTarjetas'] = $this->pagoReservaAlojamientoModel->getEmpresasTarjetas();

            if (isset($_POST["idReserva"])) {
                $_SESSION["idReserva"] = $_POST["idReserva"];
            }

            echo $this->render->renderizar("view/PagoReservaAlojamiento.mustache", $data);

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

                if (isset($_SESSION["reservaAlojamientos"]) && isset($_SESSION["comprobanteAlojamiento"])) {

                    $alojamiento = $_SESSION["reservaAlojamientos"];
                    $comprobanteReservaAlojamiento = $_SESSION["comprobanteAlojamiento"];

                    if ($this->pagoReservaAlojamientoModel->getRegistrarTarjeta($nroTarjeta, $nombreTitular, $mesVencimiento,
                            $anioVencimiento, $tarjeta, $codSeguridad) && $this->pagoReservaAlojamientoModel->actualizarReserva($idReserva)) {

                        $habitaciones = $alojamiento[0]["cant_habitaciones"];
                        $destino = $alojamiento[0]["descripcion"];
                        $precio = $alojamiento[0]["precio"];
                        $nombreAlojamiento = $alojamiento[0]["nombreAlojamiento"];

                        $_SESSION["reservaHabitaciones"] = $habitaciones;
                        $_SESSION["reservaDestino"] = $destino;
                        $_SESSION["reservaPrecio"] = $precio;
                        $_SESSION["reservaNomAlojamiento"] = $nombreAlojamiento;

                        $this->enviarEmail($habitaciones, $destino, $precio, $nombreAlojamiento, $comprobanteReservaAlojamiento);

                        $data["pagado"] = true;

                    } else {

                        $data["pagado"] = false;

                    }
                }

                echo $this->render->renderizar("view/confirmacionPagoAlojamiento.mustache", $data);
            }
        }
    }

    public function enviarEmail($habitaciones, $destino, $precio, $nombreAlojamiento, $comprobanteReservaAlojamiento){

        $nombre = $_SESSION['nombre'];
        $apellido = $_SESSION['apellido'];
        $email = $_SESSION['email'];

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
               <strong>COD COMPROBANTE DE RESERVA: </strong><span>".$comprobanteReservaAlojamiento."</span>
                <br>  
                Reserva realizada por: ".$nombre." ".$apellido."
                <br>
                Alojamiento: <strong>".$nombreAlojamiento."</strong>
                <br>
                Cantidad de habitaciones: <strong>".$habitaciones."</strong>  
                <br>
                Con destino a: <strong>".$destino."</strong>
                <br>
                Precio: <strong>".$precio."</strong>
               </p>
            </div>
        </div> ";

        return $this->phpMailer->send($email, "RESERVA DE ALOJAMIENTO", $message);

    }

    public function crearPDFAlojamiento(){
        if(isset($_SESSION['logueado'])){

            $nombre= $_SESSION["nombre"];
            $apellido= $_SESSION["apellido"];
            $habitaciones = $_SESSION["reservaHabitaciones"];
            $destino = $_SESSION["reservaDestino"];
            $precio = $_SESSION["reservaPrecio"];
            $nombreAlojamiento = $_SESSION["reservaNomAlojamiento"];
            $comprobanteReservaAlojamiento = $_SESSION['comprobanteAlojamiento'];

            $host = "http://".$_SERVER['HTTP_HOST'];

            $message ="
            <div>
                <div style='display:flex; flex-direction:row;'>
                    <span>
                        <img src='$host/GauchoRocket/public/images/marca-pdf.png' style='width:60rem;'/>
                    </span>
                </div>
                <div>
                    <h2 style='text-align: center'>Reserva de alojamiento</h2>
                   <p>
                   <strong>COD COMPROBANTE DE RESERVA: </strong><span>".$comprobanteReservaAlojamiento."</span>
                    <br>
                    Reserva realizada por: ".$nombre." ".$apellido."
                    <br>
                    Alojamiento: <strong>".$nombreAlojamiento."</strong>
                    <br>
                    Cantidad de habitaciones: <strong>".$habitaciones."</strong>
                    <br>
                    Con destino a: <strong>".$destino."</strong>
                    <br>
                    Precio: <strong>".$precio."</strong>
                   </p>
                </div>
            </div> ";


            $data["pdfAlojamiento"]=$this->pdf->createPDF($message,'reservaAlojamiento');

            echo $this->render->renderizar("view/pdfAlojamiento.mustache", $data);
        }
        else{
            header("Location: /GauchoRocket/login");
            exit();
        }

    }

    public function crearQrAlojamiento(){

        $nombre = $_SESSION['nombre'];
        $apellido = $_SESSION['apellido'];
        $habitaciones = $_SESSION["reservaHabitaciones"];
        $destino = $_SESSION["reservaDestino"];
        $precio = $_SESSION["reservaPrecio"];
        $nombreAlojamiento = $_SESSION["reservaNomAlojamiento"];
        $comprobanteReservaAlojamiento = $_SESSION['comprobanteAlojamiento'];

        $host = "http://".$_SERVER['HTTP_HOST'];

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
               <strong>COD COMPROBANTE DE RESERVA: </strong><span>".$comprobanteReservaAlojamiento."</span>
                <br>
                Reserva realizada por: ".$nombre." ".$apellido."
                <br>
                Alojamiento: <strong>".$nombreAlojamiento."</strong>
                <br>
                Cantidad de habitaciones: <strong>".$habitaciones."</strong>
                <br>
                Con destino a: <strong>".$destino."</strong>
                <br>
                Precio: <strong>".$precio."</strong>
               </p>
            </div>
        </div>
        ";

        $data['qr']= $this->qr->createQR($message);

        echo $this->render->renderizar("view/qr.mustache");

    }

}