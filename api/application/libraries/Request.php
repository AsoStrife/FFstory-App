<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request extends Message {


	// Istanza di codeigniter
	private $ci;
	// Chiave privata 
	protected $private_key; 
	// Chiave di login
	protected $login_key; 
	// Payload del campo data
	protected $data;

	/**
	 * Il costruttore prende i valori della richiesta GET o POST
	 * e li setta negli attributi della classe
	 * $data conterrà i parametri passati come richiesta
	 */
	public function __construct(){
		parent::__construct();
		$this->ci =& get_instance();

		if($this->requestType == "get"){
			$keys = json_decode($this->ci->input->get("keys"), 1);
			$this->private_key = $keys['private_key'];
			$this->login_key = $keys['login_key'];

			$this->data = json_decode($this->ci->input->get("data"), 1);
		}

		if($this->requestType == "post"){
			$keys = json_decode($this->ci->input->post("keys"), 1);
			$this->private_key = $keys['private_key'];
			$this->login_key = $keys['login_key'];

			$this->data = json_decode($this->ci->input->post("data"), 1);
		}

	}

	/**
	 * Restituisce true se la chiave privata è accettata dal sistema
	 */
	protected function checkPrivateKey(){
		if(in_array($this->private_key, $this->ci->config->item('private_keys')))
			return true;
		
		return false;
	}

	/**
	 * Restituisce true se la chiave di login è accettata dal sistema
	 */
	public function checkLoginKey(){
		if($this->ci->login_keys_model->checkLoginKey($this->login_key))
			return true;
		
		return false;
	}

	/** 
	 * Restituisco un elemeno dell'array data
	 * Ad esempio se $data contiene: $data = array("limit" => 10)
	 * e passo come parametro "limit", il metodo restituirà 10.
	 * Se il parametro è un array, restituirà un array
	 */
	public function get($parameter){
		if(empty($this->data))
			return null;

		if(array_key_exists($parameter, $this->data))
			return $this->data[$parameter];
		else
			return null;
	}

	/**
	 * Restituisco il campo data
	 */
	public function getData(){
		return $this->data;
	}

}