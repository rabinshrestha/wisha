<?php
class Fruit_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->table_name =  'fruit';
	}

	function getFruitsList(){
		$this->db->select();
		$this->db->from($this->table_name);
		// 		$this->db->limit($page['limit'],$page['limitstart']);
		$result = $this->db->get();
		// 		echo $this->db->last_query();
		// 		die();
		// 		print_r( $result->result_array());
		// 		die();
		$fruit = $result->result();
		// 		$rs = $this->db->query('select FOUND_ROWS() AS total');
		// 		$total_arr = $rs->row();
		// 		$fruit['total'] = $total_arr->total;
		return $fruit;
	}

	function getFruitDetail($slug)
	{
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('fruit_slug'.$this->current_lang ,$slug);
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

	function getFruitVariety($id)
	{
		$this->db->select();
		$this->db->from('variety');
		$this->db->where('fruit_id',$id);
		$result = $this->db->get();
		return $result->result_array();
	}

	function getVarietyDetail($slug)
	{
		$this->db->select();
		$this->db->from('variety');
		$this->db->where('variety_slug'.$this->current_lang ,$slug);
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

	function getVarietyCountry($varietyId)
	{
		$this->db->select('country_name, country_name_de, country_slug, country_slug_de');
		$this->db->from('variety_country');
		$this->db->join('country','variety_country.country_id = country.country_id', 'inner');
		$this->db->where('variety_country.variety_id',$varietyId);
		$this->db->where('country.country_active','on');
		$result = $this->db->get();
		// 		print_r($result->result_array());
		// 		die();
		return $result->result_array();
	}

	function getCountryDetail($slug)
	{
		$this->db->select();
		$this->db->from('country');
		$this->db->where('country_slug'.$this->current_lang ,$slug);
		$result = $this->db->get();
		//echo $this->db->last_query();
		if($result->num_rows()>0){
			return $result->result_array();
		}else{
			return FALSE;
		}

	}

	function getCountryProducer($countryId)
	{
		$this->db->select('producer_name, producer_name_de, producer_slug, producer_slug_de' );
		$this->db->from('producer');
		$this->db->where('country_id',$countryId);
		$result = $this->db->get();
		return $result->result_array();
	}

	function getProducerDetail($slug)
	{
		$this->db->select();
		$this->db->from('producer');
		$this->db->where('producer_slug'.$this->current_lang ,$slug);
		$this->db->where('producer_active','on');
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