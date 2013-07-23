<?php defined('BASEPATH') or die('Direct access is not allowed');
class Admin extends Admin_Controller{
	function __construct(){
		parent::__construct();
		$this->recipe_id = 0;
		$this->per_page = 10;
	}

	function index(){
		$data = array();
		$this->load->helper('icon');
		$this->load->library('pagination');
		//echo 'teest';
		//die();
		$this->load->model('adminrecipe/mdl_adminrecipe');
		$config['per_page'] = $this->per_page;
		$config['cur_page'] = $this->uri->segment(4);
		$page['limitstart'] = (int)$config['cur_page'];
		$page['limit'] = $config['per_page'];
		$list = $this->mdl_adminrecipe->getRecipeList($page);
		$config['base_url'] = site_url().'admin/adminrecipe/index';
		$config['total_rows'] = $list['total'];
		$data['recipies'] = $list['recipe'];
		$this->pagination->initialize($config);
		$pagination =  $this->pagination->create_links();
		$data['pagination'] = $pagination;
		$data['page'] = $page;

		// 		print_r($list);
		// 		die();
		$this->template->set_breadcrumb('Recipe','');
		$this->template->title('Recipe','Recipe');
		$this->template->build('admin/adminrecipe',$data);
	}

	function delete($recipe_id){
		//$this->load->model(array('freight/mdl_states'));
		$this->load->model('adminrecipe/mdl_adminrecipe');
		//delete image first
		$this->mdl_adminrecipe->delete_image(array('recipe_id'=>$recipe_id));
		if($this->mdl_adminrecipe->delete(array('recipe_id'=>$recipe_id))){
			$this->session->set_flashdata('success_delete','Deleted successfully');
		}else{
			$this->session->set_flashdata('error_delete','Could not delete');
		}
		redirect('admin/adminrecipe');
	}

	function create(){
		$this->load->model('adminrecipe/mdl_adminrecipe');

		$this->template->set_breadcrumb('recipe',site_url().'admin/adminrecipe');
		$this->template->set_breadcrumb(ucfirst($this->uri->segment('3')),'');
		$this->template->title('Admin','recipe',ucfirst($this->uri->segment('3')));
		$this->form_validation->set_rules('recipe_name','recipe Name(fr)','required');
		$this->form_validation->set_rules('recipe_desc','recipe description(fr)','required');
		$this->form_validation->set_rules('recipe_name_de','recipe Name(de)','required');
		$this->form_validation->set_rules('recipe_desc_de','recipe description(de)','required');

		$recipe_id = $this->input->post('recipe_id');
		if($this->form_validation->run() == FALSE){
			$recipe_details = $this->mdl_adminrecipe->getRecipeDetails($this->recipe_id);

			$data = array('recipe_details'=>$recipe_details);
			$this->template->build('adminrecipe/admin/edit_adminrecipe',$data);
		}else{
			//save country
			//$country_id = $this->input->post('country_id');
			$recipe_name = $this->input->post('recipe_name');
			$recipe_desc = $this->input->post('recipe_desc');
			$recipe_name_de = $this->input->post('recipe_name_de');
			$recipe_desc_de = $this->input->post('recipe_desc_de');
			$recipe_active = $this->input->post('recipe_active');
			$recipe_slug = str_replace(' ', '-', strtolower($recipe_name));
			$recipe_slug_de = str_replace(' ', '-', strtolower($recipe_name_de));
			$data = array(
					'recipe_name' =>$recipe_name,
					'recipe_desc' =>$recipe_desc,
					'recipe_name_de' =>$recipe_name_de,
					'recipe_desc_de' =>$recipe_desc_de,
					'recipe_active'=>$recipe_active,
					'recipe_slug' => $recipe_slug,
					'recipe_slug_de' => $recipe_slug_de
			);
			// 			print_r($data);
			// 			echo '</br></br>';
			// 			print_r($country_ids);
			// 			echo '</br></br>';

			// 			$this->mdl_adminvariety->insertVarietyEntry('2',array('1'));
			// 			die();

			//for fruit variety image
			$config['upload_path'] = './assets/uploads/recipe/';
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
				@unlink($config['upload_path'].$this->input->post('recipe_image_old'));
				$upload_data =  $this->upload->data();
				$data['recipe_image'] = $upload_data['file_name'];
				$config = array();
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/uploads/recipe/'.$upload_data['file_name'];
				$config['new_image'] = './assets/uploads/recipe/_thumbs/';
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 270;
				$config['height'] = 400;
					
				// 				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);

					
				$this->image_lib->resize();
				@unlink($config['new_image'].$this->input->post('recipe_image_old'));
			}


			if($this->mdl_adminrecipe->save($data,$recipe_id)){
				$this->session->set_flashdata('success_save','Recipe has been successfully added');
			}else{
				$this->session->set_flashdata('error_save','Recipe could not be saved successfully');
			}
			redirect('admin/adminrecipe');
		}
	}

	function edit($recipe_id){
		$this->recipe_id = $recipe_id;
		$this->create();
	}
}
?>
