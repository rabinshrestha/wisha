<?php defineD('BASEPATH') or die('Direct access is not allowed');
class Mdl_adminrecipe extends MY_Model{
	function __construct(){
		parent::__construct();
		$this->table_name = 'recipe';
		$this->primary_key = 'recipe_id';
	}
	function getRecipeList($page){
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->limit($page['limit'],$page['limitstart']);
		$result = $this->db->get();
		// 		echo $this->db->last_query();
		// 		die();
		// 		print_r( $result->result_array());
		// 		die();
		$recipe['recipe'] = $result->result();
		$rs = $this->db->query('select FOUND_ROWS() AS total');
		$total_arr = $rs->row();
		$recipe['total'] = $this->db->get($this->table_name)->num_rows();
		return $recipe;
	}
	function getRecipeDetails($recipe_id){
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('recipe_id',$recipe_id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		if($result->num_rows()>0){
			return $result->result();
		}else{
			$details = array();
			@$details[0]->recipe_name = '';
			$details[0]->recipe_id = 0;
			$details[0]->recipe_desc = '';
			$details[0]->recipe_name_de = '';
			$details[0]->recipe_desc_de = '';
			$details[0]->recipe_active = 'on';
			$details[0]->recipe_image = '1';
			return $details;
		}
	}
}








