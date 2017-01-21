<?php

class Authentication extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->helper('url_helper');
    }
	
	public function index()
	{
		$this->load->helper(array('form','url'));
		
		$this->load->library('form_validation');
		$this->load->library('session');
		
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
			$this->load->library('session');
			$row = $this->auth_model->auth_validation();
			$nome = $row['nome'];
			$categoria = $row['fkCategoria'];
			$this->auth_model->auth_session($nome,$categoria);
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('email_check','O Email ou Senha não é valido.');
			return FALSE;
		}
	}
	
	
}
?>