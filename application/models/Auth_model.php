<?php
class Auth_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	public function auth_validation()
	{
		
		$data = array(
			'email'=>$this->input->post('email'),
			'password'=>$this->input->post('password')
		);
		
		$query = $this->db->get_where('user', array('email'=>$data['email'],'senha'=>$data['password'],'status'=>'1') );
		return $query->row_array();
	}
	
	
}
?>