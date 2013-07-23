<?php
class About extends CI_Controller
{
	public function __construct() {
		parent::__construct();
// 		$this->load->model('welcome_model');
// 		$this->lang->load('welcome');
				echo 'this is test';
// 				die();
		$this->load->helper('language');
		// 		die();
	}

	public function index()
	{
// 		$data['current_lang'] = $this->lang->line('content');
		// 		$data['records'] = $this->welcome_model->get_all_data();
		// 		$this->load->view('welcome_message',$data);
// 		echo $this->lang->line('title');
		$this->load->view('about');
	}
}