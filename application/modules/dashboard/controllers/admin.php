<?php defined('BASEPATH') or die('Direct access is not allowed');

class Admin extends Admin_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		
// 		$data = array();		
		$this->template->set_breadcrumb('Dashboard','');
		$this->template->title('Admin','Dashboard');
		$this->template->build('dashboard');
	}
}
?>
