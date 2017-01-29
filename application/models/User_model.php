<?php

class User_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}

	public function getall_user(){
		
		
	}
	
	public function get_user($idUser){
		$query = $this->db->get_where('user',array('iduser'=>$idUser));
		return $query->result_array();
	}
}

?>
