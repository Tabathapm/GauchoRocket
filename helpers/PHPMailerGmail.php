<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'third-party/phpmailer/Exception.php';
require 'third-party/phpmailer/PHPMailer.php';
require 'third-party/phpmailer/SMTP.php';

class PHPMailerGmail{

	private $mail;
	private $email;
	private $pass;

	public function __construct($emailGR, $passGR){

		$this->mail = new PHPMailer();
		$this->email= $emailGR;
		$this->pass= $passGR;

		self::setting($this->mail, $this->email, $this->pass);
		
	}

   
	public function send($emailUser, $subject, $message){


		$this->mail->SetFrom($this->email, 'Gaucho Rocket');
		$this->mail->AddAddress($emailUser);

		$this->mail->isHTML(true); 

		$this->mail->Subject = $subject;
		$this->mail->Body = $message;
		$this->mail->AltBody = 'This is a plain-text message body';

		self::disableVerification($this->mail);
		$enviado = self::result($this->mail);

		return $enviado;
	}

	public static function disableVerification($mail){

		$disableVerification = $mail->smtpConnect([
		   'ssl' => [
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    ]
		]);


		return $disableVerification;
	}


	public static function result($mail){

		if(!$mail->Send()) {
			return false;
		}else {
		return true;
		}

	}


	public static function setting($mail, $email, $pass){

		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->SMTPDebug  = 0;
		$mail->Username = $email;
		$mail->Password = $pass;

	}

	public function getMail(){
		return $this->mail;
	}
}