<?php defined('BASEPATH') or die('Direct access is not allowed');
class Admin extends Admin_Controller{
	function __construct(){
		parent::__construct();
		$this->cms_id = 0;
		$this->per_page = 10;
	}

	function index(){
		$data = array();
		$this->load->helper('icon');
		$this->load->library('pagination');
		//echo 'teest';
		//die();
		$this->load->model('admincms/mdl_admincms');
		$config['per_page'] = $this->per_page;
		$config['cur_page'] = $this->uri->segment(4);
		$page['limitstart'] = (int)$config['cur_page'];
		$page['limit'] = $config['per_page'];
		$list = $this->mdl_admincms->getCmsList($page);
		$config['base_url'] = site_url().'admin/admincms/index';
		$config['total_rows'] = $list['total'];
		$data['cms'] = $list['cms'];
		$this->pagination->initialize($config);
		$pagination =  $this->pagination->create_links();
		$data['pagination'] = $pagination;
		$data['page'] = $page;

		// 		print_r($list);
		// 		die();
		$this->template->set_breadcrumb('CMS','');
		$this->template->title('CMS','CMS');
		$this->template->build('admin/admincms',$data);
	}

	function delete($cms_id){
		//$this->load->model(array('freight/mdl_states'));
		$this->load->model('admincms/mdl_admincms');
		if($this->mdl_admincms->delete(array('cms_id'=>$cms_id))){
			$this->session->set_flashdata('success_delete','Deleted successfully');
		}else{
			$this->session->set_flashdata('error_delete','Could not delete');
		}
		redirect('admin/admincms');
	}

	function create(){
		$this->load->model('admincms/mdl_admincms');

		$data = array();
		//check if there is already entry for active project and concept
		$data['category_status'] = $this->mdl_admincms->getCmsStatus();
		// 		print_r($data);
		// 		die();

		$this->template->set_breadcrumb('CMS',site_url().'admin/admincms');
		$this->template->set_breadcrumb(ucfirst($this->uri->segment('3')),'');
		$this->template->title('Admin','CMS',ucfirst($this->uri->segment('3')));
		$this->form_validation->set_rules('cms_title','CMS Title(fr)','required');
		$this->form_validation->set_rules('cms_desc','CMS description(fr)','required');
		$this->form_validation->set_rules('cms_title_de','CMS Title(de)','required');
		$this->form_validation->set_rules('cms_desc_de','CMS description(de)','required');
		$this->form_validation->set_rules('cms_category','CMS category','required');
		//$this->form_validation->set_rules('cms_active','CMS status','required');
		$cms_id = $this->input->post('cms_id');
		if($this->form_validation->run() == FALSE){
			$cms_details = $this->mdl_admincms->getCmsDetails($this->cms_id);
			$data['cms_details'] = $cms_details;
			$this->template->build('admincms/admin/edit_admincms',$data);
		}else{
			//save country
			//$country_id = $this->input->post('country_id');
			$cms_title = $this->input->post('cms_title');
			$cms_desc = $this->input->post('cms_desc');
			$cms_category = $this->input->post('cms_category');
			$cms_title_de = $this->input->post('cms_title_de');
			$cms_desc_de = $this->input->post('cms_desc_de');
			$cms_active = $this->input->post('cms_active');
			$cms_slug = str_replace(' ', '-', strtolower($cms_title));
			$cms_slug_de = str_replace(' ', '-', strtolower($cms_title_de));
			$data = array(
					'cms_title' =>$cms_title,
					'cms_desc' =>$cms_desc,
					'cms_title_de' =>$cms_title_de,
					'cms_desc_de' =>$cms_desc_de,
					'cms_active' => $cms_active,
					'cms_category' =>$cms_category,
					'cms_slug' => $cms_slug,
					'cms_slug_de' => $cms_slug_de
			);
			// 			print_r($data);
			// 			die();

			if($this->mdl_admincms->save($data,$cms_id)){
				$this->session->set_flashdata('success_save','CMS has been successfully added');
			}else{
				$this->session->set_flashdata('error_save','CMS could not be saved successfully');
			}
			redirect('admin/admincms');
		}
	}

	function edit($cms_id){
		$this->cms_id = $cms_id;
		$this->create();
	}
}
?>
