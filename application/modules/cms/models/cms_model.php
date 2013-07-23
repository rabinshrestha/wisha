<?php
class Cms_model extends CI_Model
{
	private $table_name = 'cms';
	private $table_name1 = 'url_helper';
	public function __construct()
	{
		//parent::__construct();
		$this->load->database();
	}


	public function get_cms_detail($category)
	{
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('cms_category',$category);
		$this->db->where('cms_active','on');
		$result = $this->db->get();
		return $result->row();

	}

	public function getUrlData($input)
	{
		$this->db->select();
		$this->db->from('list_url');
		$this->db->where($input['column_name'],$input['column_value']);	
// 		$this->db->where('cms_active','on');
		$result = $this->db->get();
		
		return $result->row_array();
		/*
		echo 'inside model';
		print_r($input);
		$this->db->select();
		$this->db->from($table_name);
		// 		$this->db->where($input['column_name'],$input['column_value']);
		$this->db->where('fruit_id','test');
		$result = $this->db->get();
		// 		$result = $this->db->get();
		// 		die();
		print_r($result);
		die();
		die();
		*/
	}
}