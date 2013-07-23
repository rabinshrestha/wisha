<?php defined('BASEPATH') or die('Direct access is not allowed');
class Admin extends Admin_Controller{
	function __construct(){
		parent::__construct();
		$this->producer_id = 0;
		$this->per_page = 10;
	}

	function index(){
		$data = array();
		$this->load->helper('icon');
		$this->load->library('pagination');
		//echo 'teest';
		//die();
		$this->load->model('adminproducer/mdl_adminproducer');
		$config['per_page'] = $this->per_page;
		$config['cur_page'] = $this->uri->segment(4);
		$page['limitstart'] = (int)$config['cur_page'];
		$page['limit'] = $config['per_page'];
		$list = $this->mdl_adminproducer->getProducerList($page);
		$config['base_url'] = site_url().'admin/adminproducer/index';
		$config['total_rows'] = $list['total'];
		$data['producers'] = $list['producer'];
		$this->pagination->initialize($config);
		$pagination =  $this->pagination->create_links();
		$data['pagination'] = $pagination;
		$data['page'] = $page;

		// 		print_r($list);
		// 		die();
		$this->template->set_breadcrumb('Producer','');
		$this->template->title('Producer','Producer');
		$this->template->build('admin/adminproducer',$data);
	}

	function delete($producer_id){
		//$this->load->model(array('freight/mdl_states'));
		$this->load->model('adminproducer/mdl_adminproducer');
		//delete images associated with this entry
		$images = $this->mdl_adminproducer->deleteImages($producer_id);

		foreach ($images as $image)
		{
			unlink('./assets/uploads/producers/'.$image['image_name']);
			unlink('./assets/uploads/producers/_thumbs/'.$image['image_name']);
		}



		if($this->mdl_adminproducer->delete(array('producer_id'=>$producer_id))){
			$this->session->set_flashdata('success_delete','Deleted successfully');
		}else{
			$this->session->set_flashdata('error_delete','Could not delete');
		}
		redirect('admin/adminproducer');
	}

	private function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

	function create(){
		$this->load->model('adminproducer/mdl_adminproducer');
		//load model for country name list
		$this->load->model('country/mdl_country');

		$this->template->set_breadcrumb('producer',site_url().'admin/adminproducer');
		$this->template->set_breadcrumb(ucfirst($this->uri->segment('3')),'');
		$this->template->title('Admin','producer',ucfirst($this->uri->segment('3')));
		$this->form_validation->set_rules('producer_name','producer Name(fr)','required');
		$this->form_validation->set_rules('producer_desc','producer description(fr)','required');
		$this->form_validation->set_rules('producer_name_de','producer Name(de)','required');
		$this->form_validation->set_rules('producer_desc_de','producer description(de)','required');
		$this->form_validation->set_rules('producer_location','producer location','required');
		// 		$this->form_validation->set_rules('country_id','producer country id(fr)','required');
		$this->form_validation->set_rules('country_id_de','producer country id(de)','required');
		$this->form_validation->set_rules('country_id', '', 'required|matches[country_id_de]');
		$producer_id = $this->input->post('producer_id');
		if($this->form_validation->run() == FALSE){
			$producer_details = $this->mdl_adminproducer->getProducerDetails($this->producer_id);
			$country_list = $this->mdl_country->getAllCountryList();
			$image_list = $this->mdl_adminproducer->getImageList($this->producer_id);
			// 			print_r($image_list);
			// 			die();

			$data = array('producer_details'=>$producer_details, 'country_list'=>$country_list, 'image_list' => $image_list);
			$this->template->build('adminproducer/admin/edit_adminproducer',$data);
		}else{
			//save country
			//$country_id = $this->input->post('country_id');
			$producer_name = $this->input->post('producer_name');
			$producer_desc = $this->input->post('producer_desc');
			$producer_name_de = $this->input->post('producer_name_de');
			$producer_desc_de = $this->input->post('producer_desc_de');
			$producer_active = $this->input->post('producer_active');
			$producer_location = $this->input->post('producer_location');
			$country_id = $this->input->post('country_id');
			$producer_slug = str_replace(' ', '-', strtolower($producer_name));
			$producer_slug_de = str_replace(' ', '-', strtolower($producer_name_de));
			$producer_image_count = $this->input->post('producer_image_count');
			$data = array(
					'producer_name' =>$producer_name,
					'producer_desc' =>$producer_desc,
					'producer_name_de' =>$producer_name_de,
					'producer_desc_de' =>$producer_desc_de,
					'producer_location' =>$producer_location,
					'country_id' => $country_id,
					'producer_active'=>$producer_active,
					'producer_slug' => $producer_slug,
					'producer_slug_de' => $producer_slug_de
			);

			// 			print_r($data);
			// 			echo 'image count: '.$producer_image_count;
			// 			die();

			$number = $producer_image_count;
			// 			$page_id = $this->input->post('page_id');
			//$i = 1;

			$config['upload_path'] = './assets/uploads/producers/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['file_name'] = $this->generateRandomString(15);

			$this->load->library('upload', $config);
			$images = array();

			for ($k = 1; $k <= $number; $k++) {
				// 				if($_FILES['userfile'.$k])
				// 				{

				//	$config['file_name'] = 'image'.$k;
				//$field_name = $_FILES['files'.$k.''];
				if ( !$this->upload->do_upload("userfile".$k))
					// if(!$this->upload->do_upload('files['.$k.']'))
				{
					//	echo "heiii";die();
					$error = array('error' => $this->upload->display_errors());
					//redirect('admin/pages');
					print_r($error);
					// 					die();
					//print_r($error);die();

					//	$this->load->view('upload_form', $error);
				}
				else
				{
					//delete old image first
					@unlink($config['upload_path'].$this->input->post('producer_image_old'.$k));
					@unlink($config['upload_path'].'_thumbs/'.$this->input->post('producer_image_old'.$k));
					// 					@unlink('./assets/uploads/producers/_thumbs/'.$this->input->post('producer_image_old'.$k));
					$upload_data =  $this->upload->data('userfile'.$k.'');

					$images['image_name'.$k] = $upload_data['file_name'];
					$config1 = array();
					$config1['image_library'] = 'gd2';
					$config1['source_image'] = './assets/uploads/producers/'.$upload_data['file_name'];
					$config1['new_image'] = './assets/uploads/producers/_thumbs/';
					$config1['maintain_ratio'] = TRUE;
					$config1['width'] = 270;
					$config1['height'] = 400;
					// 					$this->load->library('image_lib', $config1);
					$this->image_lib->initialize($config1);
					// 					$this->image_lib->resize();
					if ( ! $this->image_lib->resize())
					{
						echo $this->image_lib->display_errors();
					}
					// 					echo $upload_data['file_name'];
					// 					echo '</br></br>';
					$this->image_lib->clear();

					if($this->producer_id != 0)
					{
						$this->db->where('image_name', $this->input->post('producer_image_old'.$k));
						$this->db->update('image',array(
								'producer_id'	=>	$this->producer_id,
								'image_name'	=>	$upload_data['file_name']
						));
					}
				}
				// 					$result = $this->login_model->upload_file($this->table_name, $data['upload_data']['file_name'],$page_id);

				// 				}
				//	array_push($files1, 'files_'.$k.'');
			}

			//die('upload complete');

			if($this->mdl_adminproducer->save($data,$producer_id)){
				//save producer image detail into image table
				$producerId = 0;
				$starting = $this->input->post('producer_image_old_count');
				$end =  $this->input->post('producer_image_count');
				// 				echo $starting.'</br>';
				// 				echo $end;
				// 				die('die here');
				if($this->producer_id == 0)
				{
					// get recently inserted producer id
					$this->db->select_max('producer_id');
					$query = $this->db->get('producer');
					$producerId = $query->first_row()->producer_id;
				}
				else
				{
					// edit option
					$producerId = $this->input->post('producer_id');
					// delete initial entry for this producer
					// 					$this->db->where('producer_id',$producerId);
					//$this->db->delete('image');
				}

				for($i = $starting+1; $i<= $end; $i++)
				{
					$this->db->insert('image',array(
							'image_name'	=>	$images['image_name'.$i],
							'producer_id'	=>	$producerId
					));

				}

				$this->session->set_flashdata('success_save','producer has been successfully added');
			}else{
				$this->session->set_flashdata('error_save','producer could not be saved successfully');
			}
			redirect('admin/adminproducer');
		}
	}

	function edit($producer_id){
		$this->producer_id = $producer_id;
		$this->create();
	}
}
?>
