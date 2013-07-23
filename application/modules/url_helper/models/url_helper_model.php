<?php
class Url_helper_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function getData($input)
	{
		$this->db->select();
		$this->db->from('user_helper');
		$this->db->where($input['column_name'],$input['column_value']);
		$result = $this->db->get();
	}
}