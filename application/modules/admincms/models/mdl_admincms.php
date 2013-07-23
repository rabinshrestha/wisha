<?php defineD('BASEPATH') or die('Direct access is not allowed');
class Mdl_admincms extends MY_Model{
	function __construct(){
		parent::__construct();
		$this->table_name = 'cms';
		$this->primary_key = 'cms_id';
	}
	function getCmsList($page){
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->limit($page['limit'],$page['limitstart']);
		$result = $this->db->get();
		// 		echo $this->db->last_query();
		// 		die();
		// 		print_r( $result->result_array());
		// 		die();
		$cms['cms'] = $result->result();
		$cms['total'] = $this->db->get($this->table_name)->num_rows();
		return $cms;
	}
	function getCmsDetails($cms_id){
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('cms_id',$cms_id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		if($result->num_rows()>0){
			return $result->result();
		}else{
			$details = array();
			@$details[0]->cms_title = '';
			$details[0]->cms_id = 0;
			$details[0]->cms_desc = '';
			$details[0]->cms_title_de = '';
			$details[0]->cms_desc_de = '';
			$details[0]->cms_category = '';
			$details[0]->cms_active = '0';
			return $details;
		}
	}

	function getCmsStatus()
	{
		$this->db->select('cms_id');
		$result['concept'] = $this->db->get_where($this->table_name,array('cms_category'=>'concept','cms_active'=>'on'))->row_array();
		// 		$result['concept'] = $this->db->get_where($this->table_name,array('cms_category'=>'concept','cms_active'=>'on'))->num_rows();
		$this->db->select('cms_id');
		$result['project'] = $this->db->get_where($this->table_name,array('cms_category'=>'project','cms_active'=>'on'))->row_array();
		return $result;
	}
}
