<?php
class Fruit extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('fruit_model','model');
	}

	function index()
	{
		// display the list of fruits
		$fruits['fruits'] = $this->model->getFruitsList();
		$this->load->view('cms/header_inner');
		$this->load->view('fruit_list_view',$fruits);
		$this->load->view('cms/footer');
	}

	// load fruit list and it's underlying details
	function url_master()
	{
		// 		die();
		// 		$uri = $this->uri->uri_string();
		// 		echo $uri;
		$this->lang->load('common');
		/*
		 if($this->uri->segment(7) != FALSE)
		 {
		// too long url
		echo 'sorry page not found';

		}
		*/
		if ($this->uri->segment(6) != FALSE)
		{
			if($this->uri->segment(6) == 'gallery')
			{
				// show gallery page
				$result['producerDetail'] = $this->model->getProducerDetail(urldecode($this->uri->segment(5)));

				if($result['producerDetail'] == FALSE)
				{
					// error 404 page not found
					// 					echo 'sorry page not found';
					show_404();
					// 				exit;
				}
				else
				{
					$this->load->model('adminproducer/mdl_adminproducer');
					$result['imageDetail'] = $this->mdl_adminproducer->getImageList($result['producerDetail'][0]['producer_id']);
					// specified fruit found so display its page
					// 					$this->load->view('producer_detail_view',$result);
					$this->load->view('cms/header_inner');
					$this->load->view('gallery_view',$result);
					$this->load->view('cms/footer');
				}
				// $this->load>view('gallery_view');
			}
			else if(urldecode($this->uri->segment(6)) == 'location')
			{
				// show location page
				$result['producerDetail'] = $this->model->getProducerDetail(urldecode($this->uri->segment(5)));

				if($result['producerDetail'] == FALSE)
				{
					// error 404 page not found
					echo 'sorry page not found';
					// 				exit;
				}
				else
				{
					// specified fruit found so display its page
					// 					$this->load->view('producer_detail_view',$result);
					$this->load->view('map_view',$result);
					$this->load->view('cms/footer');

				}
			}
			else
			{
				// page not found
				show_404();;
			}
		}
		else if($this->uri->segment(5) != FALSE)
		{
			// it is the production farm
			// it is the country page
			$result['producerDetail'] = $this->model->getProducerDetail(urldecode($this->uri->segment(5)));

			// 			print_r($result['countryDetail']);
			// 			exit;

			if($result['producerDetail'] == FALSE)
			{
				// error 404 page not found
				show_404();;
				// 				exit;
			}
			else
			{
				$this->load->model('adminproducer/mdl_adminproducer');
				$result['imageDetail'] = $this->mdl_adminproducer->getImageList($result['producerDetail'][0]['producer_id']);
				// specified fruit found so display it's page
				$this->load->view('cms/header_inner');
				$this->load->view('producer_detail_view',$result);
				$this->load->view('cms/footer');
					
			}
		}
		else if($this->uri->segment(4) != FALSE)
		{
			// it is the country page
			// 			print_r(urldecode($this->uri->segment(4)));
			// 			die();

			$result['countryDetail'] = $this->model->getCountryDetail(urldecode(urldecode($this->uri->segment(4))));
			// 			print_r($result['countryDetail']);
			// 			exit;

			if($result['countryDetail'] == FALSE)
			{
				// error 404 page not found
				show_404();
				// 				exit;
			}
			else
			{
				// specified fruit found so display it's page
				// 				print_r($result);
				// 				die();
				$result['producer'] = $this->model->getCountryProducer($result['countryDetail'][0]['country_id']);
				// 												print_r($result['producer']);
				// 												exit;
				$this->load->view('cms/header_inner');
				$this->load->view('country_detail_view',$result);
				$this->load->view('cms/footer');
					
			}
		}
		else if($this->uri->segment(3) != FALSE)
		{
			// it is the variety page
			// 			$result['variety'] = $this->model->getVarietyDetail($this->uri->segment(3));
			// 			print_r($expression)
			// 			echo 'inside variety';

			$result['varietyDetail'] = $this->model->getVarietyDetail(urldecode($this->uri->segment(3)));
			if($result['varietyDetail'] == FALSE)
			{
				// error 404 page not found
				// 				show_404();;
				show_404();
				// 				exit;
			}
			else
			{
				// specified fruit found so display it's page
				// 				print_r($result);
				// 				die();
				$result['country'] = $this->model->getVarietyCountry($result['varietyDetail'][0]['variety_id']);
				// 				print_r($result['country']);
				// 				exit;
				// 				print_r($result['country']);
				// 				die();
				// 			die();
				$this->load->view('cms/header_inner');
				$this->load->view('variety_detail_view',$result);
				$this->load->view('cms/footer');
					
			}
		}
		else if($this->uri->segment(2) != FALSE)
		{
			// it is the fruit page
			// get fruit detail
			$result['fruitDetail'] = $this->model->getFruitDetail(urldecode($this->uri->segment(2)));

			if($result['fruitDetail'] == FALSE)
			{
				// error 404 page not found
				show_404();;
				// 				exit;
			}
			else
			{
				// specified fruit found so display it's page
				// 				print_r($result);
				// 				die();
				$result['variety'] = $this->model->getFruitVariety($result['fruitDetail'][0]['fruit_id']);
				// 				exit;
				$this->load->view('cms/header_inner');
				$this->load->view('fruit_detail_view',$result);
				$this->load->view('cms/footer');

			}
			// 			print_r($result);

		}


	}
}