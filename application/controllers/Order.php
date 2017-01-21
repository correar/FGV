<?php

class Order extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->helper('url_helper');
		$this->load->helper(array('form', 'url'));
    }
	
	public function view_upload()
	{
		$this->load->library('session');
		$profile = str_replace('-',' ',$this->uri->segment(3));
		$data['profiles'] = $this->order_model->get_profile($profile);
		$data['error'] = '';
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('order/upload',$data);
		$this->load->view('order/upload_file');
		$this->load->view('templates/footer');
	}
	
	public function upload_me()
	{
		$config['upload_path']          = './assets/uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        
		$this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
			return $error;
            //$this->load->view('upload_form', $error);
        }
        else
        {
			$data = array('upload_data' => $this->upload->data());
			return $data;
            //$this->load->view('upload_success', $data);
        }
	}
}	