<?php defineD('BASEPATH') or die('Direct access is not allowed');
class Mdl_adminfruit extends MY_Model{
	function __construct(){
		parent::__construct();
		$this->table_name = 'fruit';
		$this->primary_key = 'fruit_id';
	}
	function getFruitsList($page){
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->limit($page['limit'],$page['limitstart']);
		$result = $this->db->get();
		// 		echo $this->db->last_query();
		// 		die();
		// 		print_r( $result->result_array());
		// 		die();
		$fruit['fruit'] = $result->result();
		// 		$rs = $this->db->get($this->table_name)->num_rows();
		// 		$total_arr = $rs->row();
		$fruit['total'] = $this->db->get($this->table_name)->num_rows();
		return $fruit;
	}

	function getFruitDetails($fruit_id){
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('fruit_id',$fruit_id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		if($result->num_rows()>0){
			return $result->result();
		}else{
			$details = array();
			@$details[0]->fruit_name = '';
			$details[0]->fruit_id = 0;
			$details[0]->fruit_desc = '';
			$details[0]->fruit_desc_de = '';
			$details[0]->fruit_name_de = '';
			$details[0]->fruit_image = '1';
			$details[0]->fruit_active = 'on';
			return $details;
		}
	}
	function getAllFruitList(){
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('fruit_active','on');
		$result = $this->db->get();
		$fruit['fruit'] = $result->result();
		return $fruit;
	}
}
