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

        if (isset($_SESSION["apellido"])) {
            $data["apellido"] = $_SESSION["apellido"];
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

        $usuario = $_SESSION["id"];
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

        $fecha=$data['turno'][0]["fecha"];
        $hora=$data['turno'][0]["horario"];

        if($resultado){

            if($this->sendMessageEmail($nombre, $apellido,$emailUsuario, $cm, $fecha, $hora)){

                $data['estado'] = true;

                $tipo = $this->resultadoCheckeo();

                $data['tipo']=$tipo;

                $nivelEncontrado = $this->turnoModel->getNivelVuelo($tipo);

                $this->turnoModel->cargarCheckeo($nivelEncontrado[0]["id_nivel_vuelo"], $centroMedicoEncontrado[0]["id_centro_medico"], $idTurno);
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

    public function sendMessageEmail($nombreUsuario, $apelllidoUsuario, $email, $centroMedico, $fecha, $hora){

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
               Estimada/o $nombreUsuario $apelllidoUsuario, usted tiene un turno para el
               Centro Medico: $centroMedico , para el dia $fecha a las $hora
               </p>
            </div>
        </div> ";

        return $this->phpMailer->send($email, "Turno Solicitado", $message);

    }

    public function resultadoCheckeo(){

         $resultadoChequeoMedico = rand(10, 60);

         $tipo ="";

          if($resultadoChequeoMedico >= 10 && $resultadoChequeoMedico < 30){

                $tipo=1;

            }else if($resultadoChequeoMedico>=30 && $resultadoChequeoMedico<60){

                $tipo=2;

            }else{

               $tipo=3;
            }

        return $tipo;
    }

     public function miTurno(){

         $usuario = $_SESSION["id"];

         if(!isset($_POST['cancelarTurno'])){

             if($this->turnoModel->usuarioConTurno($usuario)){

               $nombre = $_SESSION["nombre"];
               $apellido = $_SESSION["apellido"];

               $data['nombre'] = $nombre;
               $data['apellido'] = $apellido;

               $turnoEncontrado = $this->turnoModel->getTurnoPorUsuario($usuario);
               $tipoVueloEncontrado = $this->turnoModel->tipoVueloUsuario($usuario);
               $centroMedico = $this->turnoModel->getCentroMedicoPorTurno($turnoEncontrado[0]['id_turno']);

               $data['turno'] = $turnoEncontrado;
               $data['tipoVuelo'] = $tipoVueloEncontrado[0]['resultadoNivelVuelo'];
               $data['centroMedico'] = $centroMedico;
               $data['usuario'] = $usuario;

               $data['tieneTurno']=true;

             }else{

                $data['tieneTurno']=false; 
             }
              
         }else{

              if(isset($_POST['turno'])){

                  $turno = $_POST['turno'];
                  
                  if($this->turnoModel->cancelarTurno($turno,$usuario)){

                    $data['tieneTurno']=false;

                  }else{
                     $data['tieneTurno']=true;
                  }

              }

         }


         if (isset($_SESSION["logueado"])) {
            $data["logueado"] = $_SESSION["logueado"];
        }

        if (isset($_SESSION["esAdmin"])) {
            $data["esAdmin"] = $_SESSION["esAdmin"];
        }

        if (isset($_SESSION["esClient"])) {
            $data["esClient"] = $_SESSION["esClient"];
        }

        if (isset($data["logueado"])) {
            echo $this->render->renderizar("view/miTurno.mustache", $data);
        } 

    }

    


}