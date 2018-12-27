<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotes_model extends CI_Model{

	public function __construct() {
        parent::__construct();
    }
    
	/**
	 *
	 */
	public function get_quotes($id, $language_id){
		
		$id = intval($id);

		if($id && is_int($id) == true)
			$data = $this->db->select("*")->from('quotes')->where("id", $id)->order_by('id')->get()->result();
		else
			$data = $this->db->select("*")->from('quotes')->order_by('id')->get()->result();
		
		if($data)
			return $data;
		else 			
			return array();
	}

	public function get_quotes_by_hero($hero_id, $language_id){
		$hero_id = intval($hero_id);

		$data = array();
		
		if($hero_id && is_int($hero_id) == true)
			$data = $this->db->select("*")->from('quotes')->where("hero_id", $hero_id)->order_by('id')->get()->result();
		
		if($data)
			return $data;
		else 			
			return array();
	}
}