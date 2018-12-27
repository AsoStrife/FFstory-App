<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Questa classe gestisce i messaggi di risposta HTTP
 * del server. 
 *
 */
class Message {

	private $ci;
	// Piattaforma che ha mandato la richiesta 
	protected $platform;
	// Browser che ha mandato la richiesta 
	protected $browser;
	// Il tipo di richiesta mandata (post o get)
	protected $requestType;

	public function __construct(){
		$this->ci =& get_instance();

		$this->platform = $this->ci->agent->platform();
		$this->browser = $this->getBrowser();
		$this->requestType = $this->ci->input->method();
	}

	public function getRt(){
		echo $this->requestType;
	}
	
	/**
	 *
	 */
	protected function getBrowser(){
		if ($this->ci->agent->is_browser())
			return $this->ci->agent->browser().' '.$this->ci->agent->version();
		elseif ($this->ci->agent->is_robot())
			return $this->ci->agent->robot();
		elseif ($this->ci->agent->is_mobile())
			return $this->ci->agent->mobile();
		else
			return 'Unidentified User Agent';
	}

	/**
	* Quanto una richiesta generica viene elaborata correttamente viene restituito un valore 200
	*/
	private function get_200(){
		
		return array(
					"code" 		=> '200',
					"message"	=> 'La richiesta e\' stata elaborata correttamente.'
			);
	}

	/**
	* In caso di inserimento di un dato (creazione) viene restituito il codice 201
	*/
	private function get_201(){
		
		return array(
					"code" 		=> '201',
					"message"	=> 'L\'elemento e\' stato creato correttamente.'
			);
	}

	/**
	* Se la richiesta non è valida si restituisce questo messaggio
	*/
	private function get_400(){
		return array(
						"code" 		=> '400',
						"message"	=> 'Bad request, la richiesta non è stata fatta nel modo corretto.'
			);
	}		

	/**
	* La richiesta è valida, ma l'utente non è autorizzato ad eseguirla
	*/
	private function get_401(){
		return array(
						"code" 		=> '401',
						"message"	=> 'L\'utente non e\' autorizzato per ottenere questa risorsa.'
			);
	}	

	/**
	* Se la richiesta non è valida si restituisce questo messaggio
	*/
	private function get_403(){
		return array(
						"code" 		=> '403',
						"message"	=> 'Permesso negato. Forbiden.'
			);
	}	

	/**
	* Se la richiesta non è valida si restituisce questo messaggio
	*/
	private function get_404(){
		return array(
						"code" 		=> '404',
						"message"	=> 'La richiesta risulta essere non valida.'
			);
	}	

	/**
	* Quanto accade un generico errore del server.
	*/
	private function get_500(){
		
		return array(
					"code" 		=> '500',
					"message"	=> 'E\' stato riscontrato un errore generico all\'interno del server. Se l\'errore persiste contattare l\'amministratore.' 
			);
	}
	
	/**
	* Problemi con il server
	*/
	private function get_505(){
		
		return array(
					"code" 		=> '505',
					"message"	=> 'Il servizio non è disponibile' 
			);
	}

	private function get($code){
		switch($code){
			case 200:
				return $this->get_200();
				break;
			case 201:
				return $this->get_201();
				break;
			case 400:
				return $this->get_400();
				break;
			case 401:
				return $this->get_401();
				break;
			case 403:
				return $this->get_403();
				break;
			case 404:
				return $this->get_404();
				break;
			case 500:
				return $this->get_500();
				break;
			case 505:
				return $this->get_505();
				break;
		}
	}

	/**
	 * Stampa il Json Formattato ottenuto da uno dei metodi di questa classe
	 * $response sarà il tipo di messaggio da stampare
	 * ottenibile da uno dei metodi qui sopra
	 */
	public function handleMessage($code, $data = array()){
		
		$response = $this->get($code);

		
		$response['request_type'] = $this->requestType;
		$response['browser'] = $this->browser;
		$response['platform'] = $this->platform;
		$response['ip'] = $this->ci->input->ip_address();

		$message = json_encode(
					array(
						"response" 		=> $response,
						"data" 			=> $data
					),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT 
				);

		header('Content-Type: text/javascript; charset=utf8');
		print_r($message);
	}
}
