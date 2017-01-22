<?php

class Order extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->helper('url_helper');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
    }
	
	public function view_upload()
	{

		$profile = str_replace('-',' ',$this->uri->segment(3));
		$data['profiles'] = $this->order_model->get_profile($profile);
		$data['error'] = '';
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('order/upload',$data);
		$this->load->view('order/upload_file',$data);
		$this->load->view('templates/footer');
		
	}
	
	public function upload_me()
	{		
		$config['upload_path']          = './assets/uploads/';
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
			foreach ($data as $d){
				
				foreach ($d as $e=>$f){
					
					if ($e == "client_name"){
						$msg = $f;
						
						$data_session = array(
							$e.$tipo.$cnt => $f,
							'cnt' => $cnt
							
						);
						
					}
				}
			}
			$this->session->set_userdata($data_session);
			//return $data;
            //$this->load->view('upload_success', $data);
			echo $tipo;


        }
	}


	
}	


