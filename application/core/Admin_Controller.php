<?php
class Admin_Controller extends MX_Controller {
	public static $is_loaded;
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('template');
		$this->template->title('Admin');
		$this->template->set_breadcrumb('Admin',site_url().'admin');
		
		$this->load->database();
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
		$this->template->append_metadata('<link rel="stylesheet" href="'.base_url().'assets/admin/css/uniform.default.min.css">');
		$this->template->append_metadata('<link rel="stylesheet" href="'.base_url().'assets/admin/css/tipsy.css">');
		$this->template->append_metadata('<link rel="apple-touch-icon-precomposed" href="'.base_url().'apple-touch-icon-114x114.png" />');
		$this->template->append_metadata('<link rel="shortcut icon" href="'.base_url().'favicon.ico" />');
		
		
		if(!$this->session->userdata('user_id')){
			redirect('admin/login');
		}
		 if (!isset(self::$is_loaded)) {
			self::$is_loaded = TRUE;
			$this->template->set_theme('admin');
			$this->template->set_layout('default');
			$this->load->library('form_validation');          
		 }
	}
}

?>