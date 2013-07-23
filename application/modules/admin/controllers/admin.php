<?php defined('BASEPATH') or die('Direct access is not allowed');
class Admin extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	function index(){
		// 		$this->login();
		echo 'this is index1';
		die();
	}
	function login(){
		$data = array();
		$this->load->helper('form');
		$this->load->language('login','english');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->database();
		if($this->session->userdata('user_id')){
			redirect('admin/dashboard');
		}
		$this->form_validation->set_rules('username','username is required','required');
		$this->form_validation->set_rules('password','password is required','required|md5');
		if($this->form_validation->run()==FALSE){
			$this->load->library('template');
			$this->template->title('Admin - Login');
			$this->template->set_theme('admin');
			$this->template->set_layout('login');
			/**
		 	* loading js files
			**/
			$this->template->prepend_metadata('<script type="text/javascript" src="'.base_url().'assets/admin/js/jquery-1.7.1.min.js"></script>');
			$this->template->append_metadata('<script type="text/javascript" src="'.base_url().'assets/admin/js/jquery-ui-1.8.16.min.js"></script>');
			$this->template->append_metadata('<script type="text/javascript" src="'.base_url().'assets/admin/js/excanvas.js"></script>');
			$this->template->append_metadata('<script type="text/javascript" src="'.base_url().'assets/admin/js/jquery.visualize.js"></script>');
			$this->template->append_metadata('<script type="text/javascript" src="'.base_url().'assets/admin/js/jquery.tablesorter.js"></script>');
			$this->template->append_metadata('<script type="text/javascript" src="'.base_url().'assets/admin/js/jquery.date_input.min.js"></script>');
			$this->template->append_metadata('<script type="text/javascript" src="'.base_url().'assets/admin/js/jquery.minicolors.min.js"></script>');
			$this->template->append_metadata('<script type="text/javascript" src="'.base_url().'assets/admin/js/jquery.wysiwyg.js"></script>');
			$this->template->append_metadata('<script type="text/javascript" src="'.base_url().'assets/admin/js/jquery.fancybox.js"></script>');
			$this->template->append_metadata('<script type="text/javascript" src="'.base_url().'assets/admin/js/jquery.tipsy.js"></script>');
			$this->template->append_metadata('<script type="text/javascript" src="'.base_url().'assets/admin/js/jquery.uniform.min.js"></script>');
			$this->template->append_metadata('<script type="text/javascript" src="'.base_url().'assets/admin/js/custom.js"></script>');
			/**
			 * loading css
			* */
			$this->template->prepend_metadata('<link rel="stylesheet" href="'.base_url().'assets/admin/css/style.css">');
			$this->template->append_metadata('<link rel="stylesheet" href="'.base_url().'assets/admin/css/responsive.css">');
			$this->template->append_metadata('<link rel="stylesheet" href="'.base_url().'assets/admin/css/visualize.css">');
			$this->template->append_metadata('<link rel="stylesheet" href="'.base_url().'assets/admin/css/date_input.css">');
			$this->template->append_metadata('<link rel="stylesheet" href="'.base_url().'assets/admin/css/jquery.minicolors.css">');
			$this->template->append_metadata('<link rel="stylesheet" href="'.base_url().'assets/admin/css/jquery.wysiwyg.css">');
			$this->template->append_metadata('<link rel="stylesheet" href="'.base_url().'assets/admin/css/jquery.fancybox.css">');
			$this->template->append_metadata('<link rel="stylesheet" href="'.base_url().'assets/admin/css/tipsy.css">');
			$this->template->append_metadata('<link rel="apple-touch-icon-precomposed" href="'.base_url().'apple-touch-icon-114x114.png" />');
			$this->template->append_metadata('<link rel="shortcut icon" href="'.base_url().'favicon.ico" />');

			$this->template->build('admin/admin/login',$data);
		}else{
			$this->load->model('users/mdl_auth');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			//$password = md5($password);
			if($user = $this->mdl_auth->validate('login',$username,$password,'login_name','login_pass')){
				$vars = array('is_admin'=>true,'user_id'=>$user->login_id,'user_name'=>$user->login_name,'group_id'=>$user->group_id,'firstname'=>$user->login_firstname,'lastname'=>login_lastname);
				$this->mdl_auth->session_update($vars);
				redirect('admin/dashboard');
			}else{
				redirect('admin/login');
			}
		}
	}
	function logout(){
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect('admin/login');
	}
}
?>
