<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dialogues extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('dialogues_model');
	}

	/**
	 *
	 */
	public function get(){
		$id = $this->uri->segment(3);
		$response = $this->dialogues_model->get_dialogues($id);
		$this->message->handleMessage(200,  $response);
	}

}