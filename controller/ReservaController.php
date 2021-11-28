<?php

class ReservaController{

    private $render;
    private $reservaModel;
    private $pdf;

    public function __construct(\Render $render, \ReservaModel $reservaModel, \PDF $pdf){
        $this->render = $render;
        $this->reservaModel = $reservaModel;
        $this->pdf=$pdf;
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


    public function crearPDF(){

        $nombre= $_SESSION["nombre"];
        $apellido= $_SESSION["apellido"];
        $horarioReserva= $_POST['hora'];
        $cabina=$_POST['cabina'];
        $servicio=$_POST['servicio'];
        $vuelo=$_POST['vuelo'];
        $comprobanteReserva = $_POST['comprobante'];
       
        $host = "http://".$_SERVER['HTTP_HOST'];
      
        $message ="
         <div>
            <img src='$host/GauchoRocket/public/images/marca-pdf.png' style='width:60rem;'/>
            <strong>COD COMPROBANTE DE RESERVA: </strong><span>".$comprobanteReserva."</span>  
            Reserva realizada por:".$nombre." ".$apellido."
            Con servicio: ".$servicio.", cabina: ".$cabina."  
            <br>
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


    public function generarReserva(){

        $comprobanteReserva= substr(md5(uniqid(rand(),true)),0,8);

        $usuario = $_SESSION["id"];
        $nombre = $_SESSION["nombre"];
        $apellido = $_SESSION["apellido"];

        $servicio = $_POST['servicio'];
        $cabina = $_POST['cabina'];

        $horaReserva = $_POST['horario'];

        $id_vuelo = $_POST['vuelo'];

        $asiento = $_POST['asiento'];

        $empresaTarjeta = $_POST['empresaTarjeta'];
        $nroTarjeta = $_POST['nroTarjeta'];
        $titular = $_POST['nombreTitular'];
        $mes = $_POST['mesVencimiento'];
        $ano = $_POST['anoVencimiento'];
        $codSeguridad = $_POST['codSeguridad'];

        $this->reservaModel->getRegistrarTarjeta($nroTarjeta, $titular , $mes , $ano, $empresaTarjeta, $codSeguridad);
        $this->reservaModel->asientoReservado($asiento);

        $servicioEncontrado= $this->reservaModel->getServicio($servicio);
        $cabinaEncontrada = $this->reservaModel->getCabina($cabina);
        $tarjetaEncontrada = $this->reservaModel->getTarjeta($nroTarjeta);

        //$this->reservaModel->asignarTarjetaAUsuario($tarjetaEncontrada[0]['id_tarjeta'], $usuario);

        /*if($this->reservaModel->asignarTarjetaAUsuario($tarjetaEncontrada[0]['id_tarjeta'], $usuario)){*/
            $this->reservaModel->asignarTarjetaAUsuario($tarjetaEncontrada[0]['id_tarjeta'], $usuario);
             $this->reservaModel->registrarReserva($horaReserva, $tarjetaEncontrada[0]['id_tarjeta'] , $id_vuelo,$servicioEncontrado[0]['id_tipo_servicio'] ,$cabinaEncontrada[0]['id_cabina'], $usuario);

            $data['horaReserva'] = $horaReserva;
            $data['servicio'] = $servicioEncontrado[0]['id_tipo_servicio'];
            $data['cabina'] = $cabinaEncontrada[0]['id_cabina'];
            $data['vuelo'] = $id_vuelo;
            $data['comprobante']=$comprobanteReserva;
           // $data['reservaRegistrada']=true;

        /*}else{
            $data['reservaRegistrada']=false;
        }*/

        

        echo $this->render->renderizar("view/miReserva.mustache");

    }




}







