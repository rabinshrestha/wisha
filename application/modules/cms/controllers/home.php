<?php
class Home extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		// 		if(!isset($_SESSION['lang']))
		// 		{
		// 			$_SESSION['lang'] = 1;
		// 		}
		$this->load->helper('language');
		$this->lang->load('home');
	}

	public function index()
	{
		$this->load->view('header_home');
		$this->load->view('home');
		$this->load->view('footer');
	}

	// for concept page
	public function concept()
	{
		$this->load->model('cms_model');
		$data['value'] = $this->cms_model->get_cms_detail('concept');
		// 		$data['record'] = $value;
		// 		print_r($value);
		// 		die();
		// 		$data['title'] = $value['cms_title'.$this->current_lang];
		// 		$data['desc'] = $value['cms_desc'.$this->current_lang];
		$this->load->view('header_inner');
		$this->load->view('common',$data);
		$this->load->view('footer');
		// 		$this->load->view('common',$value);
	}

	// for social project page
	public function project()
	{
		$this->load->model('cms_model');
		$data['value'] = $this->cms_model->get_cms_detail('project');
		// 		$data['record'] = $value;
		// 		print_r($value);
		// 		die();

		// 		$data['title'] = $value['cms_title'.$this->current_lang];
		// 		$data['desc'] = $value['cms_desc'.$this->current_lang];

		$this->load->view('header_inner');
		$this->load->view('common',$data);
		$this->load->view('footer');
	}


	public function get_Data($input)
	{
		// 		print_r($input);
		// 		include_once 'application/modules/cms/models/cms_model.php';
		$value = array();
		foreach($input as $in=>$in_val)
		{
			$value['column_name'] = $in;
			$value['column_value'] = $in_val;
		}
		// 		print_r($value);
		// 		die();
		$this->load->model('cms/cms_model');
		$result = $this->cms_model->getUrlData($value);
		// 		$result = $this->cms_model->get_cms_detail('concept');
		// 		print_r($result);
		// 		print_r
		// 		return $result;
		// 		print_r($result);
		// 		die();
		return $result;

	}
}