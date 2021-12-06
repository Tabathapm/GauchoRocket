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
             $host = "http://".$_SERVER['HTTP_HOST'];
             $data['host']=$host;

             if(isset($_POST['idViaje']) && isset($_POST['destino'])
                && isset($_POST['horario']) && isset($_POST['fecha'])
                && isset($_POST['precio']) && isset($_POST['foto'])
                && isset($_POST['duracion']) && isset($_POST['vuelo'])
                || ( isset($_POST['origenid']) && isset($_POST['destinoid']) ) ){

                $origen=$_POST['origenid'];
                $destino=$_POST['destinoid'];

                $viaje=$_POST['idViaje'];
                $data['viaje'] = $this->reservaModel->getViaje($viaje);

                if( ($origen== 5 || $origen== 6 || $origen== 9) && ($destino=2) ){

                    $data['filaA']=$this->reservaModel->getAsientosPorFilaOrigenDestino($origen,$destino, 'A');
                    $data['filaB']=$this->reservaModel->getAsientosPorFilaOrigenDestino($origen,$destino, 'B');
                    $data['filaC']=$this->reservaModel->getAsientosPorFilaOrigenDestino($origen,$destino, 'C');
                    $data['filaD']=$this->reservaModel->getAsientosPorFilaOrigenDestino($origen,$destino, 'D');

                }else{

                    $data['filaA']=$this->reservaModel->getAsientosPorFila($_POST['destino'], 'A');
                    $data['filaB']=$this->reservaModel->getAsientosPorFila($_POST['destino'], 'B');
                    $data['filaC']=$this->reservaModel->getAsientosPorFila($_POST['destino'], 'C');
                    $data['filaD']=$this->reservaModel->getAsientosPorFila($_POST['destino'], 'D');

                }
               
                $data['destino'] = $_POST['destino'];
                $data['horario'] = $_POST['horario'];
                $data['fecha'] = $_POST['fecha'];
                $data['precio'] = $_POST['precio'];
                $data['foto'] = $_POST['foto'];
                $data['duracion'] = $_POST['duracion'];
                $data['vuelo'] = $_POST['vuelo'];
                $data['viaje'] = $_POST['idViaje'];
             }

            echo $this->render->renderizar("view/reservas.mustache", $data);

        }else{

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
        $asientoEncontrado = $this->reservaModel->getAsiento($asiento);
        $vueloEncontrado= $this->reservaModel->getReservaVuelo($id_vuelo);

        $data['horaReserva'] = $horaReserva;
        $data['servicio'] = $servicioEncontrado[0]['descripcion_tipo'];
        $data['cabina'] = $cabinaEncontrada[0]['tipo'];
        $data['vuelo'] = $id_vuelo;

       $_SESSION["horaReserva"] = $horaReserva;

       $_SESSION["cabina"] = $cabinaEncontrada[0]['id_cabina'];
       $_SESSION["fila"] = $asientoEncontrado[0]['fila'];
       $_SESSION["asiento"] = $asientoEncontrado[0]['descripcion'];
       $_SESSION["servicio"] = $servicioEncontrado[0]['id_tipo_servicio'];
       $_SESSION["vuelo"] = $vueloEncontrado;

        if($this->reservaModel->asientoReservado($asiento) &&  $this->reservaModel->registrarReserva($horaReserva,$id_vuelo,$asiento,$servicioEncontrado[0]['id_tipo_servicio'] ,$cabinaEncontrada[0]['id_cabina'], $usuario, $viaje, $comprobanteReserva)){

              $data['reservaRegistrada']=true;

        }else{

            $data['reservaRegistrada']=false;
        }

        
    }

        echo $this->render->renderizar("view/miReserva.mustache", $data);

    }



    public function reservaCompleta(){

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

            $id_usuario = $_SESSION['id'];

            if(!isset($_POST['cancelarReserva'])){

                if($this->reservaModel->getUsuarioConReserva($id_usuario)){

                $reservaViajes= $this->reservaModel->getReservasViajes($id_usuario);
                $reservaAlojamientos= $this->reservaModel->getReservasAlojamientos($id_usuario);
                $_SESSION["reservaAlojamientos"] = $reservaAlojamientos;
                $data['viajes'] = $reservaViajes;
                $data['alojamientos'] = $reservaAlojamientos;
                $data['usuarioConReserva']=true;

                }else{

                    $data['usuarioConReserva']=false;
                } 


            }else{

                $reserva = $_POST['idReserva'];

                $this->reservaModel->cancelarReserva($reserva);

                header("Location:/GauchoRocket/reserva/reservaCompleta");
                exit();


            }

            }

            
            echo $this->render->renderizar("view/reservaCompleta.mustache",$data);
        }

       
    


    public function reservarAlojamiento(){
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
            if (isset($_POST["idAlojamiento"])){

                $id_alojamiento = $_POST["idAlojamiento"];
                $comprobanteReservaAlojamiento = substr(md5(uniqid(rand(),true)),0,8);
                $_SESSION['comprobanteAlojamiento'] = $comprobanteReservaAlojamiento;
                $data['comprobanteAlojamiento'] = $comprobanteReservaAlojamiento;
                $id_usuario = $_SESSION["id"];

                $this->reservaModel->asignarUsuarioReserva($id_usuario);
                $this->reservaModel->reservarAlojamiento($id_alojamiento, $id_usuario);
                $this->reservaModel->alojamientoNoDisponible($id_alojamiento);

                $data["mensaje"] = "Reserva registrada con éxito!";
            }
        }

        echo $this->render->renderizar("view/reservaAlojamiento.mustache", $data);
    }


}

