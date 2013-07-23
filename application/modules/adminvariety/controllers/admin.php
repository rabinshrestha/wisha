<?php defined('BASEPATH') or die('Direct access is not allowed');
class Admin extends Admin_Controller{
	function __construct(){
		parent::__construct();
		$this->variety_id = 0;
		$this->per_page = 10;
	}

	function index(){
		$data = array();
		$this->load->helper('icon');
		$this->load->library('pagination');
		//echo 'teest';
		//die();
		$this->load->model('adminvariety/mdl_adminvariety');
		$config['per_page'] = $this->per_page;
		$config['cur_page'] = $this->uri->segment(4);
		$page['limitstart'] = (int)$config['cur_page'];
		$page['limit'] = $config['per_page'];
		$list = $this->mdl_adminvariety->getVarietyList($page);
		$config['base_url'] = site_url().'admin/adminvariety/index';
		$config['total_rows'] = $list['total'];
		$data['varieties'] = $list['variety'];
		$this->pagination->initialize($config);
		$pagination =  $this->pagination->create_links();
		$data['pagination'] = $pagination;
		$data['page'] = $page;

		// 		print_r($list);
		// 		die();
		$this->template->set_breadcrumb('Variety','');
		$this->template->title('Variety','Variety');
		$this->template->build('admin/adminvariety',$data);
	}

	function delete($variety_id){
		//$this->load->model(array('freight/mdl_states'));
		$this->load->model('adminvariety/mdl_adminvariety');
		//delete image first
		$this->mdl_adminvariety->delete_image(array('variety_id'=>$variety_id));
		if($this->mdl_adminvariety->delete(array('variety_id'=>$variety_id))){
			$this->session->set_flashdata('success_delete','Deleted successfully');
		}else{
			$this->session->set_flashdata('error_delete','Could not delete');
		}
		redirect('admin/adminvariety');
	}

	function create(){
		$this->load->model('adminvariety/mdl_adminvariety');
		//load model for fruit name list
		$this->load->model('adminfruit/mdl_adminfruit');

		//load model for country name list (for variety_country table)
		$this->load->model('country/mdl_country');

		$this->template->set_breadcrumb('Variety',site_url().'admin/adminvariety');
		$this->template->set_breadcrumb(ucfirst($this->uri->segment('3')),'');
		$this->template->title('Admin','Variety',ucfirst($this->uri->segment('3')));
		$this->form_validation->set_rules('variety_name','variety Name(fr)','required');
		$this->form_validation->set_rules('variety_desc','variety description(fr)','required');
		$this->form_validation->set_rules('variety_name_de','variety Name(de)','required');
		$this->form_validation->set_rules('variety_desc_de','variety description(de)','required');
		// 		$this->form_validation->set_rules('country_id','producer country id(fr)','required');
		$this->form_validation->set_rules('fruit_id','fruit variety id(fr)','required');
		$this->form_validation->set_rules('country_ids','Country name','required');
		// 		$this->form_validation->set_rules('country_ids','country ids(fr)','required');
		//$this->form_validation->set_rules('fruit_id', '', 'required|matches[fruit_id_de]');
		$variety_id = $this->input->post('variety_id');
		if($this->form_validation->run() == FALSE){
			$variety_details = $this->mdl_adminvariety->getVarietyDetails($this->variety_id);
			$fruit_details = $this->mdl_adminfruit->getAllFruitList();
			$country_details = $this->mdl_country->getAllCountryList();

			$data = array('variety_details'=>$variety_details,'fruit_details'=>$fruit_details, 'country_details'=>$country_details);
			$this->template->build('adminvariety/admin/edit_adminvariety',$data);
		}else{
			//save country
			//$country_id = $this->input->post('country_id');
			$variety_name = $this->input->post('variety_name');
			$variety_desc = $this->input->post('variety_desc');
			$variety_name_de = $this->input->post('variety_name_de');
			$variety_desc_de = $this->input->post('variety_desc_de');
			$variety_active = $this->input->post('variety_active');
			$fruit_id = $this->input->post('fruit_id');
			$country_ids = $this->input->post('country_ids');
			$variety_slug = str_replace(' ', '-', strtolower($variety_name));
			$variety_slug_de = str_replace(' ', '-', strtolower($variety_name_de));
			$data = array(
					'variety_name' =>$variety_name,
					'variety_desc' =>$variety_desc,
					'variety_name_de' =>$variety_name_de,
					'variety_desc_de' =>$variety_desc_de,
					'fruit_id' => $fruit_id,
					'variety_active'=>$variety_active,
					'variety_slug' => $variety_slug,
					'variety_slug_de' => $variety_slug_de
			);
			// 			print_r($data);
			// 			echo '</br></br>';
			// 			print_r($country_ids);
			// 			echo '</br></br>';

			// 			$this->mdl_adminvariety->insertVarietyEntry('2',array('1'));
			// 			die();

			//for fruit variety image
			$config['upload_path'] = './assets/uploads/variety/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);
			$error = array();
			if ( ! $this->upload->do_upload()){
				$error['error'] =  $this->upload->display_errors();
			}
			else{
				// 				print_r($config['upload_path'].$this->input->post('old_advertise_image'));
				// 				die();
					
				//delete old image first
				@unlink($config['upload_path'].$this->input->post('variety_image_old'));
				$upload_data =  $this->upload->data();
				$data['variety_image'] = $upload_data['file_name'];
				$config = array();
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/uploads/variety/'.$upload_data['file_name'];
				$config['new_image'] = './assets/uploads/variety/_thumbs/';
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 270;
				$config['height'] = 400;
					
				// 				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);

					
				$this->image_lib->resize();
				@unlink($config['new_image'].$this->input->post('variety_image_old'));
			}


			if($this->mdl_adminvariety->save($data,$variety_id)){

				if($variety_id != 0)
				{
					//delete all previous entry for variety in variety_country table
					$this->mdl_adminvariety->deleteVarietyEntry($variety_id);
				}
				else
				{
					// 					echo 'new variety inserted';
					$this->db->select_max('variety_id');
					$query = $this->db->get('variety');
					$variety_id = $query->first_row()->variety_id;

					// 					$variety_id = $this->db->insert_id();
				}
				// 				print_r($variety_id);
				// 				die();
				//insert new entry for variety in variety_country table
				$this->mdl_adminvariety->insertVarietyEntry($variety_id,$country_ids);

				$this->session->set_flashdata('success_save','Variety has been successfully added');
			}else{
				$this->session->set_flashdata('error_save','Variety could not be saved successfully');
			}
			redirect('admin/adminvariety');
		}
	}

	function edit($variety_id){
		$this->variety_id = $variety_id;
		$this->create();
	}
}
?>
