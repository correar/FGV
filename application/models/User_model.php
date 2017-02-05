<?php

class User_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}

	public function getall_user(){
		$this->db->select('iduser, user.nome as nome, sobrenome, email, telefone, status, departamento, unidade.nome as unidade, permissao.nome as permissao');
		$this->db->from('user');
		$this->db->join('unidade','fkUnidade = unidade.idunidade');
		$this->db->join('permissao','fkCategoria = permissao.idpermissao');
		if($query = $this->db->get()){  
			return $query->result_array();
			
		}else{
			return  $this->db->error();
			
		}
	}
	
	public function get_user($idUser){
		$query = $this->db->get_where('user',array('iduser'=>$idUser));
		return $query->result_array();
	}
	
	public function update_password(){
		$this->db->set('senha',$this->input->post('password'),FALSE);
		$this->db->where('iduser',$this->session->iduser);
		$this->db->update('user');
	}
	
	public function create_user()
	{
		$data = array(
			'nome' => $this->input->post('nome'),
			'sobrenome' => $this->input->post('sobrenome'),
			'email' => $this->input->post('email'),
			'senha' => $this->input->post('senha'),
			'telefone' => $this->input->post('telefone'),
			'departamento' => $this->input->post('departamento'),
			'fkUnidade' => $this->input->post('unidade'),
			'fkCategoria' => $this->input->post('permissao')
		);
		$this->db->insert('user', $data);
	}
}

?>
