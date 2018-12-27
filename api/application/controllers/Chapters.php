<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Chapters extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('chapters_model');
	}

	/**
	 *
	 */
	public function get(){

		$id = $this->uri->segment(3);
		$response = $this->chapters_model->get_chapters($id);
		$this->message->handleMessage(200,  $response);


	}

}