<?php
class Recipe extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('recipe_model','model');
	}

	function index()
	{
		// display the list of fruits
		$recipies['recipies'] = $this->model->getRecipiesList();
		$this->load->view('cms/header_inner');
		$this->load->view('recipe_list_view',$recipies);
		$this->load->view('cms/footer');
	}

	// load fruit list and it's underlying details
	function url_master()
	{
		// 		echo 'inside url master';
		// 		die();

		$result['recipeDetail'] = $this->model->getRecipeDetail(urldecode($this->uri->segment(3)));

		if($result['recipeDetail'] == FALSE)
		{
			show_404();
		}
		else
		{
			// specified fruit found so display it's page
			// 				print_r($result);
			// 				die();
			// 			$result['variety'] = $this->model->getFruitVariety($result['fruitDetail'][0]['fruit_id']);
			// 				exit;
			$this->load->view('cms/header_inner');
			$this->load->view('recipe_detail_view',$result);
			$this->load->view('cms/footer');

		}
		// 			print_r($result);


	}
}