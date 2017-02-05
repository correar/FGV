<?php

class Unit_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}

	public function getall_unit(){
		if($query = $this->db->get('unidade')){  
			return $query->result_array();
			
		}else{
			return  $this->db->error();
			
		}
	}
}
?>