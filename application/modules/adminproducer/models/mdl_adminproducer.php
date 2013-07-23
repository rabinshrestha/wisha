<?php defineD('BASEPATH') or die('Direct access is not allowed');
class Mdl_adminproducer extends MY_Model{
	function __construct(){
		parent::__construct();
		$this->table_name = 'producer';
		$this->primary_key = 'producer_id';
	}
	function getProducerList($page){
		$this->db->select('producer_id,
				producer_name,
				producer_desc,
				producer_name_de,
				producer_desc_de,
				producer_active,
				country_name');
		$this->db->from($this->table_name);
		$this->db->join('country', 'country.country_id = producer.country_id', 'inner');
		$this->db->limit($page['limit'],$page['limitstart']);
		$result = $this->db->get();
		// 		echo $this->db->last_query();
		// 		die();
		// 		print_r( $result->result_array());
		// 		die();
		$producer['producer'] = $result->result();
		$producer['total'] = $this->db->get($this->table_name)->num_rows();
		return $producer;
	}
	function getProducerDetails($producer_id){
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('producer_id',$producer_id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		if($result->num_rows()>0){
			return $result->result();
		}else{
			$details = array();
			@$details[0]->producer_name = '';
			$details[0]->producer_id = 0;
			$details[0]->producer_desc = '';
			$details[0]->producer_name_de = '';
			$details[0]->producer_desc_de = '';
			$details[0]->producer_active = '0';
			$details[0]->country_id = 0;
			$details[0]->producer_location = '';

			// image files
			$details[0]->producer_image1 = '0';
			$details[0]->producer_image2 = '0';
			$details[0]->producer_image3 = '0';
			$details[0]->producer_image4 = '0';
			$details[0]->producer_image5 = '0';

			// 			$details[0]->country_id = 0;
			return $details;
		}
	}

	function getImageList($producer_id){
		// 		echo $producer_id;
		// 		die();
		$this->db->select();
		$this->db->from('image');
		$this->db->where('producer_id',$producer_id);
		$result = $this->db->get();
		// 		echo $this->db->last_query();
		// 		die();
		// 		print_r( $result->result_array());
		// 		die();
		$image= $result->result_array();
		return $image;
	}

	function deleteImages($producer_id)
	{
		$this->db->select('image_name');
		$this->db->from('image');
		$this->db->where('producer_id',$producer_id);
		$result = $this->db->get();
		$value = $result->result_array();
		return $value;
	}

}
