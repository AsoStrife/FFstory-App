<?php defined('BASEPATH') OR exit('No direct script access allowed');


class CheckMethods extends Request {
	
	// Istanza di codeigniter
	private $ci;

	/**
	 * Ottengo gli attributi ereditati dalla classe Request
	 */
	public function __construct(){
		$this->ci =& get_instance();
		parent::__construct();
	}

	/**
	 * Se la richiesta non è fatta in modo corretto, ovvero tramite get o post
	 * restituisco errore 400 e chiudo l'esecuzione
	 */
	function check_method(){
		if($this->requestType != "post"){
			$this->handleMessage(400);
			exit;
		}
	}

}
