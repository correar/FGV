<?php

class Order extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
		$this->load->model('user_model');
        $this->load->helper('url_helper');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
    }
	
	public function view_upload($valor)
	{
		$profile = str_replace('-',' ',urldecode($this->uri->segment(3)));
		
		$data['profiles'] = $this->order_model->get_profile($profile);
		if (! $data['profiles']){
			$profile = $valor;
			$data['profiles'] = $this->order_model->get_profile($profile);
		}
		$data['enderecosEntrega'] = $this->order_model->getall_endereco();
		$data['error'] = '';
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('order/upload',$data);
		$this->load->view('order/upload_file',$data);
		$this->load->view('templates/footer');
		
	}
	
	public function upload_me()
	{		
		if(!is_dir('./assets/uploads/'.$this->session->iduser)){
		mkdir('./assets/uploads/'.$this->session->iduser, 0777, true);
		chmod('./assets/uploads/'.$this->session->iduser, 0777);
		}
		$config['upload_path']          = './assets/uploads/'.$this->session->iduser.'/';
        $config['allowed_types']        = 'pdf';
		$config['max_size']     = '0';
        
		$this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
			//return $error;
            //$this->load->view('upload_form', $error);
			foreach ($error as $d=>$e){
				
					$msg .= $d." ".$e."<br>";
					
				
			}
			
			echo $msg;
        }
        else
        {
			$data = array('upload_data' => $this->upload->data());
			$tipo = $this->input->post('tipo');
			$cnt = $this->input->post('cnt');
			$perfil = $this->input->post('perfil');
			foreach ($data as $d){
				
				foreach ($d as $e=>$f){
					
					if ($e == "client_name"){
						$msg = $f;
						
						$data_session = array(
							$e.$perfil.$tipo.$cnt => $f,
							'cnt' => $cnt,
							'session'.$cnt => $e.$perfil.$tipo.$cnt
							
						);
						
					}
				}
			}
			$this->session->set_userdata($data_session);
			//return $data;
            //$this->load->view('upload_success', $data);
			echo $msg;


        }
	}

	public function form()
	{
		$this->load->helper(array('form'));

        $this->load->library('form_validation');
		$this->form_validation->set_rules('quantidade', 'Quantidade', 'required', array('required' => 'A %s deve ser preenchida.'));
		$this->form_validation->set_rules('centroCusto', 'Centro de Custo', 'required', array('required' => 'O %s deve ser preenchido.'));

        if ($this->form_validation->run() == FALSE)
        {
			$profile = $this->input->post('profile');
			$this->view_upload($profile);
        }
        else{
			$cnt = $this->input->post('cnt');
			$total = $this->input->post('total');
			$data['info'] = array(
				"idProfile" => $this->input->post('idprofile'),
				"profile"=> $this->input->post('profile'),
				"observacao" => $this->input->post('observacao'),
				"quantidade"=> $this->input->post('quantidade'),
				"centroCusto"=> $this->input->post('centroCusto'),
				"endereco" => $this->input->post('endereco'),
				"total"=> $total,
				"cnt"=> $cnt
				
			);
			
			for($i=1;$i<=$total;$i++){
				$valor = $this->input->post('dataInfo'.$i);
				foreach($valor as $a=>$b){
					$data['info'][$a.$i] = $b;
					
				}
			}
			
			
			
			$data['info']['lastpedido'] = $this->order_model->set_form($data);
			
			$data['user'] = $this->user_model->get_user($this->session->iduser);
			$data['enderecoEntrega'] = $this->order_model->get_endereco($this->input->post('endereco'));
			
			$this->load->view('templates/header');
			$this->load->view('templates/menu');
            $this->load->view('order/formsuccess',$data);
			$this->load->view('templates/footer');
			
			  $config = Array(
				  
				  'protocol' => 'smtp',
				  'smtp_host' => 'smtp.boxeprint.com.br',
				  'smtp_port' => 587,
				  'smtp_user' => 'fgv@boxeprint.com.br', // change it to yours
				  'smtp_pass' => 'P3dr0.Luc4s', // change it to yours
				  'mailtype' => 'html',
				  'charset' => 'utf-8',
				  'wordwrap' => FALSE,
				  'validation' => TRUE,
				  'newline' => '\r\n'
				);
			$this->load->library('email');
			$this->email->initialize($config); 
			$this->email->from('fgv@boxeprint.com.br', 'Boxeprint FGV');
			$this->email->to('rodrigo.tornaciole@gmail.com');
			//$this->email->cc('another@another-example.com');
			//$this->email->bcc('them@their-example.com');

			$this->email->subject('Email Test');
			
			$message = '<div class="row">';
			$message .= '<div class="col-md-2 col-md-offset-1">';
			$message .= '<strong>Emissão:</strong> '.date('d/m/Y');
			$message .= '</div>';
			$message .= '<div class="col-md-2 col-md-offset-1">';
			$message .= '<strong>Pedido:</strong> '.$data['info']['lastpedido'];
			$message .= '</div>';
			$message .= '<div class="col-md-2 col-md-offset-1">';
			$message .= '<strong>Prazo:</strong>';
			$message .= '</div>';
			$message .= '<div class="col-md-2">';
			$message .= '</div>';
			$message .= '</div>';
			$message .= '<p></p>';
			$message .= '<div class="row">';
			$message .= '<div class="col-md-3 col-md-offset-1">Usuário:</div>';
			$message .= '<div class="col-md-8">';
			foreach($data['user'] as $key){
				$message .= $key['nome']." ".$key['sobrenome']." | ".$key['telefone']." | ".$key['email'];
			}
			$message .= '</div></div>';
			$message .= '<div class="row">';
			$message .= '<div class="col-md-3 col-md-offset-1">Identificação do Pedido:</div>';
			$message .= '<div class="col-md-8">'.$data['info']['observacao'].'</div></div>';
			
			$dataEntrega = date('d/m/Y',strtotime('+36 hours'));
			$message .= '<div class="row"><div class="col-md-3 col-md-offset-1">Data Entrega:</div><div class="col-md-8">'.$dataEntrega.'</div><div>';
			$message .= '<div class="row"><div class="col-md-3 col-md-offset-1">Observações:</div><div class="col-md-8"></div></div>';
			$message .= '<div class="row"><div class="col-md-3 col-md-offset-1">Endereço pra entrega:</div><div class="col-md-8">';
			foreach($data['enderecoEntrega'] as $key){
				$message .= $key['logradouro'].", ".$key['numero'].", ".$key['bairro'];
			}
			$message .= '</div></div>';
			$message .= '<div class="row"><div class="col-md-3 col-md-offset-1">Quantidade:</div>';
			$message .= '<div class="col-md-8">'.$data['info']['quantidade'].'</div></div>';
			$message .= '<div class="row"><div class="col-md-3 col-md-offset-1">Centro de Custo:</div>';
			$message .= '<div class="col-md-8">'.$data['info']['centroCusto'].'</div></div>';

			$total = $data['info']['total'];
			$cnt = $data['info']['cnt'];
			for($i=1;$i<=$total;$i++){
				$tipo = $data['info']['tipo'.$i];
				$profile = $data['info']['idProfile'];
				for($j=1;$j<=$cnt;$j++){
					if($data['info']['arquivo'.$profile.$tipo.$j.$i]<>""){
						$message .= '<div class="row"><div class="col-md-3 col-md-offset-1">Item</div>';
						$message .= '<div class="col-md-8">'.$data['info']['tipo'.$i]." | ".$data['info']['coloracao'.$i]." | ".$data['info']['gramatura'.$i]." | ".$data['info']['formato'.$i]." | ".$data['info']['lado'.$i]." | ".$data['info']['arquivo'.$profile.$tipo.$j.$i];
						$message .= '</div></div>';
					}
				}
			}

			
			$this->email->message($message);

			if($this->email->send())
			{
			  echo 'Email sent.';
			 }
			 else
			{
			 show_error($this->email->print_debugger());
			}
        }
	}
	

	
}	


