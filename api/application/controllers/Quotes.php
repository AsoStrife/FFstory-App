<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quotes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('quotes_model');
	}

	/**
	 * id, quote, hero_id, language_id
	 */
	public function get(){
		$id = $this->uri->segment($this->config->item('uri_id'));
		$language_id = $this->uri->segment($this->config->item('uri_language'));

		$response = $this->quotes_model->get_quotes($id, $language_id);
		$this->message->handleMessage(200,  $response);
	}

	/**
	 * 
	 */
	public function get_by_hero(){
		$id = $this->uri->segment($this->config->item('uri_id'));
		$language_id = $this->uri->segment($this->config->item('uri_language'));

		$response = $this->quotes_model->get_quotes_by_hero($id, $language_id);
		$this->message->handleMessage(200,  $response);
	}

}