<?php
class Recipe_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->table_name =  'recipe';
	}

	function getRecipiesList(){
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('recipe_active','on');
		// 		$this->db->limit($page['limit'],$page['limitstart']);
		$result = $this->db->get();
		// 		echo $this->db->last_query();
		// 		die();
		// 		print_r( $result->result_array());
		// 		die();
		$recipe = $result->result();
		// 		$rs = $this->db->query('select FOUND_ROWS() AS total');
		// 		$total_arr = $rs->row();
		// 		$fruit['total'] = $total_arr->total;
		return $recipe;
	}

	function getRecipeDetail($slug)
	{
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('recipe_slug'.$this->current_lang ,$slug);
		$result = $this->db->get();
		// 		print_r($result->result_row());
		// 		die();
		//echo $this->db->last_query();
		if($result->num_rows()>0){
			return $result->result_array();
		}else{
			return FALSE;
		}
	}
}