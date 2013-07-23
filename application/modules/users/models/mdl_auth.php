<?php
class Mdl_Auth extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function validate($table_name,$username,$password,$user_field,$password_field){
		$this->db->select();
		$this->db->from($table_name);
		$this->db->where($user_field,$username);
// 		$this->db->where('group_id',1);
		$result = $this->db->get();
		$user = $result->row();
		if($result->num_rows()>0){
			if($password == $user->$password_field){
				return $user;
			}else{
				$this->session->set_flashdata('login_error',$this->lang->line('username_or_password_incorrect'));
				redirect('admin/login');
			}
		}else{
			$this->session->set_flashdata('login_error',$this->lang->line('username_or_password_incorrect'));
			redirect('admin/login');
		}
	}
	function session_update($vars){
		$this->load->library('session');
		$this->session->set_userdata($vars);
	}
}