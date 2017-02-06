<?php

class Report extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('report_model');
		$this->load->library('session');
    }
	
	public function view_report()
	{
		$data['reports'] = $this->report_model->getall_report();
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('report/report',$data);
		$this->load->view('templates/footer');
	}
}