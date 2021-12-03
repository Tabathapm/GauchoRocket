<?php

class RegistrarseController{

    private $render;
    private $usuarioModel;
    private $phpMailer;

    public function __construct(\Render $render, \UsuarioModel $usuarioModel, \PHPMailerGmail $phpMailer){
        $this->render = $render;
        $this->usuarioModel = $usuarioModel;
        $this->phpMailer = $phpMailer;
    }

    public function execute(){
        $data = array();

        if(isset($_SESSION['registroIncorrecto']) && $_SESSION['registroIncorrecto'] === 1){
            $data['registroIncorrecto'] = "Hubo un problema, intente nuevamente.";
            unset($_SESSION['registroIncorrecto']);
        }

        if(isset($_SESSION['emailExistente']) && $_SESSION['emailExistente'] === 1){
            $data['emailExistente'] = "Ya posee una cuenta con ese Email.";
            unset($_SESSION['emailExistente']);
        }

        if(isset($_SESSION['clavesIncorrectas']) && $_SESSION['clavesIncorrectas'] === 1){
            $data['clavesIncorrectas'] = "Las contraseñas no coinciden.";
            unset($_SESSION['clavesIncorrectas']);
        }

        if(isset($_SESSION['mensaje'])){
            $data['mensaje'] = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }

        echo $this->render->renderizar("view/registrarse.mustache", $data);
    }

    public function validarRegistro(){
        if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['clave']) && isset($_POST['clave-repetida'])){
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $pass = $_POST['clave'];
            $repass = $_POST['clave-repetida'];
            $hash = md5(rand(0, 1000));

            if (isset($pass) === isset($repass)){
                if(!$this->usuarioModel->getUsuarioSiExisteMail($email)){
                    $password = md5($pass);
                    $this->usuarioModel->registrarUsuario($nombre,$apellido,$email,$password, $hash);
                    $enviarEmail = $this->verificacionPorEmail($nombre, $apellido, $email, $hash);

                    if ($enviarEmail){
                        $_SESSION["mensaje"] = "Cuenta creada, activar via link por email";
                        header("Location: /GauchoRocket/registrarse");
                        exit();
                    }else{
                        $_SESSION['registroIncorrecto'] = 1;
                        header("Location: /GauchoRocket/registrarse");
                        exit();
                    }
                }else{
                    $_SESSION['emailExistente'] = 1;
                    header("Location: /GauchoRocket/registrarse");
                    exit();
                }
            }else{
                $_SESSION['clavesIncorrectas'] = 1;
                header("Location: /GauchoRocket/registrarse");
                exit();
            }
        }else{
            $_SESSION['registroIncorrecto'] = 1;
            header("Location: /GauchoRocket/registrarse");
            exit();
        }
    }


    public function verificacionPorEmail($nombre, $apelllido, $email, $hash){

        $host = "http://".$_SERVER['HTTP_HOST'];

        $mailer =  $this->phpMailer->getMail();
        $mailer->AddEmbeddedImage('public/images/icon-email.png', 'logo');
        
        $msj ="
        <div>
            <div style='display:flex; flex-direction:row;'>
                <span>
                    <img src='cid:logo' width=40>
                </span>
                <h1>Gaucho Rocket</h1>
            </div>
            <div>
                <h3>Hola $nombre $apelllido!</h3>
               <p>
               Gracias por registrarte, haz clic en el siguiente enlace o pégalo en la url de tu navegador.
               </p> <br>
               <h4>
                    $host/GauchoRocket/validacion?email=$email&hash=$hash
                </h4>
            </div>
        </div> ";

        return $this->phpMailer->send($email, "ACTIVAR REGISTRO", $msj);

    }
}