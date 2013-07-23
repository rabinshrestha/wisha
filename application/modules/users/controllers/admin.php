<?php

defined('BASEPATH') or die('Direct access is not allowed');

class Admin extends Admin_Controller {

	function __construct() {
		parent::__construct();
		$this->user_id = 0;
		$this->per_page = 10;
	}

	function owner() {
		$data = array();
		$this->load->helper('icon');
		$this->load->library('pagination');
		$this->load->model('users/mdl_users');
		$config['per_page'] = $this->per_page;
		$config['cur_page'] = $this->uri->segment(4);
		$page['limitstart'] = (int) $config['cur_page'];
		$page['limit'] = $config['per_page'];
		$list = $this->mdl_users->getUserList($page, array("group_id" => 1));
		$config['base_url'] = site_url() . 'admin/users/owner';
		$config['total_rows'] = $list['total'];
		$data['users'] = $list['users'];
		$this->pagination->initialize($config);
		$pagination = $this->pagination->create_links();
		$data['pagination'] = $pagination;
		$data['page'] = $page;
		//$this->template->set_breadcrumb('Users', '');
		//$this->template->set_breadcrumb('Owner', '');
		$this->template->title('Admin', 'Users');
		$this->template->build('admin/users', $data);
	}

	function delete($user_id) {
		$this->load->model(array('users/mdl_users'));
		if ($this->mdl_users->delete(array('login_id' => $user_id))) {
			$this->session->set_flashdata('success_delete', 'User deleted successfully');
		} else {
			$this->session->set_flashdata('failure_delete', 'User could not be deleted');
		}
		redirect('admin/users/owner');
	}
	function create() {

		//         $this->load->model(
		//                 array('users/mdl_users', 'boats/boats_model', 'activity/activity_model', 'locations/locations_model', 'experiences/experiences_model'));
		$this->load->model(
				array('users/mdl_users'));
		$this->load->library('form_validation');
		//$this->form_validation->CI = & $this;
		//$this->template->set_breadcrumb('Users', site_url() . 'admin/users');
		//$this->template->set_breadcrumb(ucfirst($this->uri->segment('3')), '');

		$this->form_validation->set_rules('first_name', 'first name  ', 'required');
		$this->form_validation->set_rules('last_name', 'last name  ', 'required');
		$this->form_validation->set_rules('signup', '', '');
		$password = $this->input->post("password");

		$this->form_validation->set_rules('password', 'Password is required', 'required');
		$this->form_validation->set_rules('user_name', 'UserName is required', 'required');

		$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email|callback_email_check');
		$user_id = $this->input->post('user_id');

		if (!empty($password)) {
			$this->form_validation->set_rules('cofirm_password', 'Password Confirmation', 'required|matches[password]');
		}
		if ($this->form_validation->run() == FALSE) {
			//echo 'inside if';
			//echo $this->user_id;
			//die();
			$user_details = $this->mdl_users->getUserDetails($this->user_id);
			// 			print_r($user_details);
			// 			die();
			// 			print_r($user_details);
			// 			die();
			//             $list = $this->boats_model->getBoatsList('', array('b.status' => 1));
			//             $act = $this->activity_model->getActsList('', array('a.status' => 1));
			//             $locations = $this->mdl_users->getRadius_owner();
			//             $exps	 = $this->experiences_model->getExpsList('', array('e.status' => 1));

			//$sizes = $this->mdl_users->getBoatSize();
			// 			echo 'here';
			// 			die();
			$data = array(
					'user_details' => $user_details,
			);
			$this->template->build('users/admin/edit_user', $data);
			//echo 'test';
		} else {
			//save user
			$data = array(
					'login_firstname' => $this->input->post('first_name'),
					'login_lastname' => $this->input->post('last_name'),
					'login_email' => $this->input->post('user_email'),
					'login_name' => $this->input->post('user_name'),
					'login_id' => $this->input->post('user_id'),
					'login_status' => '1',
					'group_id' => '1',

			);
			if (!empty($password)) {
				$data['login_pass'] = md5($password);
			}

			// 			print_r($data);
			// 			die();
			// 			echo $user_id;
			// 			die();
			if ($this->mdl_users->save($data, $user_id)) {
				$this->session->set_flashdata('success_save', 'User has been saved successfully.');
			} else {
				$this->session->set_flashdata('success_save', 'User could not be saved.');
			}
			redirect('admin/users/owner');
		}
	}

	function edit($user_id) {
		$this->user_id = $user_id;
		$this->create();
	}
}

?>
