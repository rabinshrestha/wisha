<?php
class Url_helper extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_Data($input)
	{
		$this->load->model('url_helper_model','model');
		$result = $this->model->getData($input);
		return $result;

	}
}