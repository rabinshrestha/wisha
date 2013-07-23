<?php defineD('BASEPATH') or die('Direct access is not allowed');
class Mdl_adminvariety extends MY_Model{
	function __construct(){
		parent::__construct();
		$this->table_name = 'variety';
		$this->primary_key = 'variety_id';
	}
	function getVarietyList($page){
		$this->db->select('variety_id,
				variety_name,
				variety_desc,
				variety_name_de,
				variety_desc_de,
				variety_active,
				fruit_name');
		$this->db->from($this->table_name);
		$this->db->join('fruit', 'fruit.fruit_id = variety.fruit_id', 'inner');
		$this->db->limit($page['limit'],$page['limitstart']);
		$result = $this->db->get();
		// 		echo $this->db->last_query();
		// 		die();
		// 		print_r( $result->result_array());
		// 		die();
		$variety['variety'] = $result->result();
		$variety['total'] = $this->db->get($this->table_name)->num_rows();
		return $variety;
	}
	function getVarietyDetails($variety_id){
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('variety_id',$variety_id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		if($result->num_rows()>0){
			return $result->result();
		}else{
			$details = array();
			@$details[0]->variety_name = '';
			$details[0]->variety_id = 0;
			$details[0]->variety_desc = '';
			$details[0]->variety_name_de = '';
			$details[0]->variety_desc_de = '';
			$details[0]->variety_active = 'on';
			$details[0]->variety_image = '1';
			$details[0]->fruit_id = 0;
			// 			$details[0]->country_id = 0;
			return $details;
		}
	}

	function deleteVarietyEntry($variety_id)
	{
		$tableName = 'variety_country';
		$this->db->where('variety_id', $variety_id);
		$this->db->delete($tableName);

	}

	function insertVarietyEntry($variety_id,$country_ids)
	{
		$tableName = 'variety_country';
		$data = Null;
		foreach ($country_ids as $country_id)
		{
			$data = array('variety_id' => $variety_id, 'country_id' => $country_id);
			$this->db->insert($tableName,$data);
		}
	}
}








