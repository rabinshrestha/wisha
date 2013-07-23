<?php defined('BASEPATH') or die('Direct access is not allowed');
class Admin extends Admin_Controller{
	function __construct(){
		parent::__construct();
		$this->fruit_id = 0;
		$this->per_page = 10;
	}

	function index(){
		$data = array();
		$this->load->helper('icon');
		$this->load->library('pagination');
		$this->load->model('adminfruit/mdl_adminfruit');
		$config['per_page'] = $this->per_page;
		$config['cur_page'] = $this->uri->segment(4);
		$page['limitstart'] = (int)$config['cur_page'];
		$page['limit'] = $config['per_page'];
		$list = $this->mdl_adminfruit->getFruitsList($page);
		$config['base_url'] = site_url().'admin/adminfruit/index';
		$config['total_rows'] = $list['total'];
		$data['fruits'] = $list['fruit'];
		$this->pagination->initialize($config);
		$pagination =  $this->pagination->create_links();
		$data['pagination'] = $pagination;
		$data['page'] = $page;

		// 		print_r($list);
		// 		die();
		$this->template->set_breadcrumb('fruit','');
		$this->template->title('Fruit','Fruit');
		$this->template->build('admin/adminfruit',$data);
	}

	function delete($fruit_id){
		//$this->load->model(array('freight/mdl_states'));
		$this->load->model('adminfruit/mdl_adminfruit');
		//delete image first
		$this->mdl_adminfruit->delete_image(array('fruit_id'=>$fruit_id));
		if($this->mdl_adminfruit->delete(array('fruit_id'=>$fruit_id))){
			$this->session->set_flashdata('success_delete','Deleted successfully');
		}else{
			$this->session->set_flashdata('error_delete','Could not delete');
		}
		redirect('admin/adminfruit');
	}

	function create(){
		$this->load->model(array('adminfruit/mdl_adminfruit'));
		$this->template->set_breadcrumb('Fruit',site_url().'admin/adminfruit');
		$this->template->set_breadcrumb(ucfirst($this->uri->segment('3')),'');
		$this->template->title('Fruit','Fruit',ucfirst($this->uri->segment('3')));
		$this->form_validation->set_rules('fruit_name','fruit name','required');
		$this->form_validation->set_rules('fruit_desc','fruit description','required');
		$this->form_validation->set_rules('fruit_name_de','fruit name(fr)','required');
		$this->form_validation->set_rules('fruit_desc_de','fruit description(de)','required');
		$fruit_id = $this->input->post('fruit_id');
		if($this->form_validation->run() == FALSE){
			$fruit_details = $this->mdl_adminfruit->getFruitDetails($this->fruit_id);
			$data = array('fruit_details'=>$fruit_details);
			$this->template->build('adminfruit/admin/edit_adminfruit',$data);
		}else{




			//save fruit
			//$fruit_id = $this->input->post('fruit_id');
			$fruit_name = $this->input->post('fruit_name');
			$fruit_description = $this->input->post('fruit_desc');
			$fruit_name_de = $this->input->post('fruit_name_de');
			$fruit_description_de = $this->input->post('fruit_desc_de');
			$fruit_active = $this->input->post('fruit_active');
			$fruit_slug = str_replace(' ', '-', strtolower($fruit_name));
			$fruit_slug_de = str_replace(' ', '-', strtolower($fruit_name_de));
			$data = array(
					'fruit_name' =>$fruit_name,
					'fruit_desc' =>$fruit_description,
					'fruit_name_de' =>$fruit_name_de,
					'fruit_desc_de' =>$fruit_description_de,
					'fruit_active' => $fruit_active,
					'fruit_slug' => $fruit_slug,
					'fruit_slug_de' => $fruit_slug_de
			);
			// 			print_r($data);
			// 			die();

			//for fruit image
			$config['upload_path'] = './assets/uploads/fruits/';
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
				@unlink($config['upload_path'].$this->input->post('fruit_image_old'));
				$upload_data =  $this->upload->data();
				$data['fruit_image'] = $upload_data['file_name'];
				// 				$config1 = array();
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/uploads/fruits/'.$upload_data['file_name'];
				$config['new_image'] = './assets/uploads/fruits/_thumbs/';
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 270;
				$config['height'] = 400;
				// 				$this->load->library('image_lib', $config1);
				$this->image_lib->initialize($config);
					
				if ( ! $this->image_lib->resize())
				{
					echo $this->image_lib->display_errors();
					// 					die();
				}
				// 				$this->image_lib->resize();
				// 				die();
				@unlink($config['new_image'].$this->input->post('fruit_image_old'));
			}

			if($this->mdl_adminfruit->save($data,$fruit_id)){
				$this->session->set_flashdata('success_save','fruit has been successfully added');
			}else{
				$this->session->set_flashdata('error_save','fruit could not be saved successfully');
			}
			redirect('admin/adminfruit');
		}
	}

	function edit($fruit_id){
		$this->fruit_id = $fruit_id;
		$this->create();
	}
}
?>
