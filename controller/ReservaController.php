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

        $data['servicios'] = $this->reservaModel->servicios();
        $data['cabinas'] = $this->reservaModel->cabinas();

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

        $data['tipoVuelo'] = $this->reservaModel->getResultadoChequeo($_SESSION["id"]);

        if (isset($data["logueado"])) {
            echo $this->render->renderizar("view/reservas.mustache", $data);
        }else{
            echo $this->render->renderizar("view/login.mustache");
        }
    }


    public function crearPDF($datosVuelo){

        $nombre=$datosVuelo[0]['nombre'];
        $apellido=$datosVuelo[0]['apellido'];
        $horarioReserva=$datosVuelo[0]['horaReserva'];


        $message ="
         <div>
            <h1>Gaucho Rocket</h1>
            <div>
                <p>
                  Reserva realizada por: $nombre $apellido,

                  Para el vuelo en el dia en el horario
                  
                </p>
            </div>
         </div>

         ";

         $data['pdf']=$this->pdf->createPDF($message,'reserva');

        if(isset($_SESSION['logueado'])){
            echo $this->render->renderizar("view/reservas.mustache");
        }
        else{
            header("Location: /GauchoRocket/login");
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

        $servicioEncontrado= $this->reservaModel->getServicio($servicio);
        $cabinaEncontrada = $this->reservaModel->getCabina($cabina);

        $guardarReserva= $this->reservaModel->registrarReserva($horaReserva,'123', $id_vuelo,$servicioEncontrado[0]['id_tipo_servicio'] ,$cabinaEncontrada[0]['id_cabina'], $usuario);


        echo $this->render->renderizar("view/miReserva.mustache");

    }




}




