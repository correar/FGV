<?php

class Authentication extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
		$this->load->model('user_model');
        $this->load->helper('url_helper');
		$this->load->library('session');
    }
	
	public function index()
	{
		$this->load->helper(array('form','url'));
		
		$this->load->library('form_validation');
		//$this->load->library('session');
		for($i=1;$i<=$this->session->cnt;$i++){
			$valor = $this->session->session.$i;
			$this->session->unset_userdata($valor);
			$this->session->unset_userdata($this->session->session.$i);
		}
		$this->session->unset_userdata('cnt');
		
		$this->form_validation->set_rules('email', 'Email', 'callback_email_check|valid_email|required', array('required'=>'O %s deve ser preenchido.'));
		$this->form_validation->set_rules('password', 'Senha', 'trim|required', array('required'=>'A %s deve ser preenchida.'));
		
		if (($this->form_validation->run() == TRUE) or ($this->session->nome <> '')) 
		{
			$this->load->view('templates/header');
			$this->load->view('templates/menu');
			$this->load->view('templates/home');
			$this->load->view('templates/footer');	
		}
		else
		{			
	
			$this->load->view('templates/header');
			$this->load->view('auth.php');
			$this->load->view('templates/footer');
			
		}
	}
	
	public function email_check($str)
	{
		if(($str == '') or ($this->auth_model->auth_validation()))
		{
			//$this->load->library('session');
			$row = $this->auth_model->auth_validation();
			$idUser = $row['iduser'];
			$nome = $row['nome'];
			$categoria = $row['fkCategoria'];
			$this->auth_session($idUser,$nome,$categoria);
			return TRUE;
		}
		else
		{
			$row = $this->auth_model->nopassword();
			$password = $row['senha'];
			if($password == ""){
				
				
				$idUser = $row['iduser'];
				$nome = $row['nome'];
				$categoria = $row['fkCategoria'];
				$this->auth_session($idUser,$nome,$categoria);
				$this->user_model->update_password();
				return TRUE;
			}
			else{
				$this->form_validation->set_message('email_check','O Email ou Senha não é valido.');
				return FALSE;
			}
		}
	
	}
	
	public function auth_session($idUser,$nome,$categoria)
	{
		$data = array(
			'iduser' => $idUser,
			'nome' => $nome,
			'categoria' => $categoria,
			'logged_in' => TRUE
		);
		
		$this->session->set_userdata($data);
	}
	public function logout()
	{
		$this->session->sess_destroy();
		$this->load->view('templates/logout');
	}
	
	public function update_password()
	{
		$this->load->helper(array('form','url'));
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('password', 'Senha', 'trim|required', array('required'=>'A %s deve ser preenchida.'));
		
		if (($this->form_validation->run() == FALSE)){
				
				$this->user_model->update_password();
				
				
			
		}else
		{
			$this->load->view('templates/header');
			$this->load->view('user/password');
			$this->load->view('templates/footer');
		}
		
	}
	
}
?>