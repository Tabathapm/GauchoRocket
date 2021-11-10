<?php

class TurnoController{

    private $render;
    private $turnoModel;
    private $phpMailer;

    public function __construct(\Render $render, \TurnoModel $turnoModel, \PHPMailerGmail $phpMailer){
        $this->render = $render;
        $this->turnoModel = $turnoModel;
        $this->phpMailer = $phpMailer;
    }


    public function execute(){

        $data = array();

        if (isset($_SESSION["logueado"])) {
            $data["logueado"] = $_SESSION["logueado"];
        }

        if (isset($_SESSION["nombre"])) {
            $data["nombre"] = $_SESSION["nombre"];
        }

        if (isset($_SESSION["esAdmin"])) {
            $data["esAdmin"] = $_SESSION["esAdmin"];
        }

        if (isset($_SESSION["esClient"])) {
            $data["esClient"] = $_SESSION["esClient"];
        }

        if (isset($_SESSION["id"])) {
            $data["id"] = $_SESSION["id"];
        }

        $centroMedico=$_POST['centro-medico'];
        $_SESSION["cMedico"] = $centroMedico;

        $turnos= $this->turnoModel->getTurnosCentroMedico($centroMedico);

        $data["centroMedico"] = $centroMedico;
        $data["turnos"] =  $turnos;

        if (isset($data["logueado"])) {
            echo $this->render->renderizar("view/turno.mustache",$data);
        }

    }

    public function crearTurno(){

        $usuario=1;
//        $usuario = $_SESSION["id"];
        $nombre = $_SESSION["nombre"];
        $apellido = $_SESSION["apellido"];

        $cm = $_SESSION["cMedico"];
        $data["centroMedico"] = $cm;

        $emailUsuario= $_SESSION["email"];

        $idTurno=$_POST['idTurno'];

        $resultado=$this->turnoModel->updateTurno($idTurno, $usuario);
        $usuarioEncontrado=$this->turnoModel->getUsuarioPorTurno($usuario, $idTurno);
        $turnoEncontrado =$this->turnoModel->getTurno($idTurno);
        $centroMedicoEncontrado = $this->turnoModel->getCentroMedicoPorTurno($idTurno);

        $data['turno'] = $turnoEncontrado;
        $data['usuario'] = $usuarioEncontrado;
        $data['centroMedico'] = $centroMedicoEncontrado;

        $message ="
        <div>
            <div>
                <span>
                    <img src='public/images/icon-email.png'>
                </span>
                <h1>Gaucho Rocket</h1>
            </div>
            <div>
               <p>
               Estimada/o ".$nombre.", usted tiene un turno para el
               Centro Medico: ".$cm." , para el dia ".$data['turno'][0]["fecha"]." a las ".$data['turno'][0]["horario"]." hs.
               </p>
            </div>
        </div> ";

        $resultadoEmail = $this->phpMailer->send($emailUsuario, "Turno Solicitado", $message);

//        $this->phpMailer->send("tabathapm@gmail.com", "Turno Solicitado", $message);


        if($resultado && $resultadoEmail){

           // $this->phpMailer->send("julietabarraza21@gmail.com", "Turno Solicitado", $message);

            $data['estado'] = true;
            $resultadoChequeoMedico = rand(10, 60);

            if($resultadoChequeoMedico >= 10 && $resultadoChequeoMedico < 30){

                $data['tipo']="Tipo 1";

            }else if($resultadoChequeoMedico>=30 && $resultadoChequeoMedico<60){

                $data['tipo']="Tipo 2";

            }else{

                $data['tipo']="Tipo 3";
            }

        }else{
             $data['estado'] = false;
        }



        if (isset($_SESSION["logueado"])) {
            $data["logueado"] = $_SESSION["logueado"];
        }

        if (isset($_SESSION["nombre"])) {
            $data["nombre"] = $_SESSION["nombre"];
        }

        if (isset($_SESSION["esAdmin"])) {
            $data["esAdmin"] = $_SESSION["esAdmin"];
        }

        if (isset($_SESSION["esClient"])) {
            $data["esClient"] = $_SESSION["esClient"];
        }

        if (isset($data["logueado"])) {
            echo $this->render->renderizar("view/resultadoCheckeo.mustache", $data);
        }
    }


}