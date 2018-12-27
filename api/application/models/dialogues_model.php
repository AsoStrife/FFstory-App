<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dialogues_model extends CI_Model{

	public function __construct() {
        parent::__construct();
    }
    
	/**
	 *
	 */
	public function get_dialogues($id){
		
		$id = intval($id);

		if($id && is_int($id) == true)
			$data = $this->db->select("*")->from('dialogues')->where("id", $id)->order_by('id')->get()->result();
		else
			$data = $this->db->select("*")->from('dialogues')->order_by('id')->get()->result();
		
		if($data)
			return $data;
		else 			
			return array();
	}

}