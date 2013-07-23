<?php defined('BASEPATH') or die('Direct access is not allowed');
class Admin extends Admin_Controller{
	function __construct(){
		parent::__construct();
		$this->country_id = 0;
		$this->per_page = 10;
	}

	function index(){
		$data = array();
		$this->load->helper('icon');
		$this->load->library('pagination');
		$this->load->model('country/mdl_country');
		$config['per_page'] = $this->per_page;
		$config['cur_page'] = $this->uri->segment(4);
		$page['limitstart'] = (int)$config['cur_page'];
		$page['limit'] = $config['per_page'];
		$list = $this->mdl_country->getCountryList($page);
		$config['base_url'] = site_url().'admin/country/index';
		$config['total_rows'] = $list['total'];
		$data['countries'] = $list['country'];
		$this->pagination->initialize($config);
		$pagination =  $this->pagination->create_links();
		$data['pagination'] = $pagination;
		$data['page'] = $page;

		// 		print_r($list);
		// 		die();
		$this->template->set_breadcrumb('Country','');
		$this->template->title('Countries','Country');
		$this->template->build('admin/country',$data);
	}

	function delete($country_id){
		//$this->load->model(array('freight/mdl_states'));
		$this->load->model('country/mdl_country');
		if($this->mdl_country->delete(array('country_id'=>$country_id))){
			$this->session->set_flashdata('success_delete','Deleted successfully');
		}else{
			$this->session->set_flashdata('error_delete','Could not delete');
		}
		redirect('admin/country');
	}

	function create(){
		$this->load->model(array('country/mdl_country'));
		$this->template->set_breadcrumb('Country',site_url().'admin/country');
		$this->template->set_breadcrumb(ucfirst($this->uri->segment('3')),'');
		$this->template->title('Countries','Country',ucfirst($this->uri->segment('3')));
		$this->form_validation->set_rules('country_name','Country name','required');
		$this->form_validation->set_rules('country_desc','Country description','required');
		$this->form_validation->set_rules('country_name_de','Country name(fr)','required');
		$this->form_validation->set_rules('country_desc_de','Country description(de)','required');
		$country_id = $this->input->post('country_id');
		if($this->form_validation->run() == FALSE){
			$country_details = $this->mdl_country->getCountryDetails($this->country_id);
			$data = array('country_details'=>$country_details);
			$this->template->build('country/admin/edit_country',$data);
		}else{
			//save country
			//$country_id = $this->input->post('country_id');
			$country_name = $this->input->post('country_name');
			$country_description = $this->input->post('country_desc');
			$country_name_de = $this->input->post('country_name_de');
			$country_description_de = $this->input->post('country_desc_de');
			$country_active = $this->input->post('country_active');
			$country_slug = str_replace(' ', '-', strtolower($country_name));
			$country_slug_de = str_replace(' ', '-', strtolower($country_name_de));
			$data = array(
					'country_name' =>$country_name,
					'country_desc' =>$country_description,
					'country_name_de' =>$country_name_de,
					'country_desc_de' =>$country_description_de,
					'country_active' => $country_active,
					'country_slug' => $country_slug,
					'country_slug_de' => $country_slug_de
			);
			// 			print_r($data);
			// 			die();

			if($this->mdl_country->save($data,$country_id)){
				$this->session->set_flashdata('success_save','Country has been successfully added');
			}else{
				$this->session->set_flashdata('error_save','Country could not be saved successfully');
			}
			redirect('admin/country');
		}
	}

	function edit($country_id){
		$this->country_id = $country_id;
		$this->create();
	}
}
?>
