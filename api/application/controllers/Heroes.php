<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Heroes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('heroes_model');
	}

	/**
	 *
	 */
	public function get(){
		$id = $this->uri->segment(3);
		$response['data'] = $this->heroes_model->get_heroes($id);
		$this->message->handleMessage(200,  $response);
	}

}