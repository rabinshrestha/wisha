<?php defined('BASEPATH') or die('Direct access is not allowed');
class Admin extends Admin_Controller{
	function __construct(){
		parent::__construct();
		$this->per_page = 10;
	}

	function index(){
		$data = array();
		$this->load->helper('icon');
		$this->load->library('pagination');
		$this->load->model('admincontact/mdl_admincontact');
		$config['per_page'] = $this->per_page;
		$config['cur_page'] = $this->uri->segment(4);
		// 		$config['base_url'] = base_url().'admin/admincontact';
		$page['limitstart'] = (int)$config['cur_page'];
		$page['limit'] = $this->per_page;
		$list = $this->mdl_admincontact->getMessageList($page);
		$config['base_url'] = site_url().'admin/admincontact/index';
		$config['total_rows'] = $list['total'];
		$data['message'] = $list['message'];
		//die();
		$this->pagination->initialize($config);
		$pagination =  $this->pagination->create_links();
		$data['pagination'] = $pagination;
		//die();
		$data['page'] = $page;

		// 		print_r($list);
		// 		die();
		$this->template->set_breadcrumb('Messages','');
		$this->template->title('Message','Message');
		$this->template->build('admin/admincontact',$data);
	}

	function delete($message_id){
		// 		echo $message_id;
		// 		die();
		//$this->load->model(array('freight/mdl_states'));
		$this->load->model('admincontact/mdl_admincontact');
		if($this->mdl_admincontact->delete(array('contact_id'=>$message_id))){
			$this->session->set_flashdata('success_delete','Deleted successfully');
		}else{
			$this->session->set_flashdata('error_delete','Could not delete');
		}
		redirect('admin/admincontact');
	}

	function detail($message_id)
	{
		$this->load->model(array('admincontact/mdl_admincontact'));
		// mark message as read
		$this->mdl_admincontact->markRead($message_id);
		$this->template->set_breadcrumb('Messages',site_url().'admin/admincontact');
		$this->template->set_breadcrumb(ucfirst($this->uri->segment('3')),'');
		$this->template->title('Message','Message',ucfirst($this->uri->segment('3')));
		$data['message'] = $this->mdl_admincontact->getMessageDetail($message_id);
		$this->template->build('admincontact/admin/detail_admincontact',$data);

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
			$data = array(
					'fruit_name' =>$fruit_name,
					'fruit_desc' =>$fruit_description,
					'fruit_name_de' =>$fruit_name_de,
					'fruit_desc_de' =>$fruit_description_de,
					'fruit_active' => $fruit_active
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
				$config = array();
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/uploads/fruits/'.$upload_data['file_name'];
				$config['new_image'] = './assets/uploads/fruits/_thumbs/';
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 270;
				$config['height'] = 400;
					
				$this->load->library('image_lib', $config);
					
				$this->image_lib->resize();
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

}
?>
