<?php defineD('BASEPATH') or die('Direct access is not allowed');
class Mdl_country extends MY_Model{
	function __construct(){
		parent::__construct();
		$this->table_name = 'country';
		$this->primary_key = 'country_id';
	}
	function getCountryList($page){
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->limit($page['limit'],$page['limitstart']);
		$result = $this->db->get();
		// 		echo $this->db->last_query();
		// 		die();
		// 		print_r( $result->result_array());
		// 		die();
		$country['country'] = $result->result();
		$country['total'] = $this->db->get($this->table_name)->num_rows();
		return $country;
	}

	function getCountryDetails($country_id){
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('country_id',$country_id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		if($result->num_rows()>0){
			return $result->result();
		}else{
			$details = array();
			@$details[0]->country_name = '';
			$details[0]->country_id = 0;
			$details[0]->country_desc = '';
			$details[0]->country_desc_de = '';
			$details[0]->country_name_de = '';
			$details[0]->country_active = 'on';
			return $details;
		}
	}
	function getAllCountryList(){
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('country_active','on');
		$result = $this->db->get();
		$country['country'] = $result->result();
		return $country;
	}
}
