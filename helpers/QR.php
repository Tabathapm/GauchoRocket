<?php

require 'third-party/phpqrcode/qrlib.php';

class QR{

	public function __construct(){

	}

   
	public function createQR($data){

		QRcode::png($data,false,QR_ECLEVEL_L,8);
		
	}

	
}