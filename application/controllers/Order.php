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
		$this->load->view('templates/footer');
	}
	
	public function do_upload()
    {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
					
					
					$data['error'] = array('error' => $this->upload->display_errors());
					$this->view_upload();
                    
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        $this->load->view('upload_success', $data);
                }
    }
}