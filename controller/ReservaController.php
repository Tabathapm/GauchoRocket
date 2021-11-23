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

             if(isset($_POST['idViaje']) && isset($_POST['destino'])
                && isset($_POST['horario']) && isset($_POST['fecha'])
                && isset($_POST['precio']) && isset($_POST['foto'])
                && isset($_POST['duracion']) && isset($_POST['vuelo']) ){

                $viaje=$_POST['idViaje'];
                $data['viaje'] = $this->reservaModel->getViaje($viaje);
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
        /*$horarioReserva= $_POST['hora'];
        $cabina=$_POST['cabina'];
        $servicio=$_POST['servicio'];
        $vuelo=$_POST['vuelo'];*/
       
        $host = "http://".$_SERVER['HTTP_HOST'];
      
        $message ="
         <div>
            <img src='$host/GauchoRocket/public/images/marca-pdf.png' style='width:60rem;'/>
            <div>
                <p>
                  Reserva realizada por:".$nombre." ".$apellido.",
                </p>
            </div>
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

        $horaReserva = time();

        $id_vuelo = $_POST['vuelo'];

        $servicioEncontrado= $this->reservaModel->getServicio($servicio);
        $cabinaEncontrada = $this->reservaModel->getCabina($cabina);

        if($this->reservaModel->registrarReserva($horaReserva,'123', $id_vuelo,$servicioEncontrado[0]['id_tipo_servicio'] ,$cabinaEncontrada[0]['id_cabina'], $usuario)){

            $data['horaReserva'] = $horaReserva;
            $data['servicio'] = $servicioEncontrado[0]['id_tipo_servicio'];
            $data['cabina'] = $cabinaEncontrada[0]['id_cabina'];
            $data['vuelo'] = $id_vuelo;
            $data['reservaRegistrada']=true;

        }else{
            $data['reservaRegistrada']=false;
            $data['mensaje']='Hubo un error, intente mas tarde!';
        }

        echo $this->render->renderizar("view/miReserva.mustache");

    }




}







