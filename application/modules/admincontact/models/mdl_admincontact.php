<?php defineD('BASEPATH') or die('Direct access is not allowed');
class Mdl_admincontact extends MY_Model{
	function __construct(){
		parent::__construct();
		$this->table_name = 'contact';
		$this->primary_key = 'contact_id';
	}
	function getMessageList($page){
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->order_by('contact_isread','asc');
		$this->db->limit($page['limit'],$page['limitstart']);
		$result = $this->db->get();
		// 		echo $this->db->last_query();
		// 		die();
		// 		print_r( $result->result_array());
		// 		die();
		$message['message'] = $result->result();
		$message['total'] = $this->db->get($this->table_name)->num_rows();
		return $message;
	}

	function getMessageDetail($message_id){
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('contact_id',$message_id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		// 		if($result->num_rows()>0){
		return $result->result();
		// 		}
	}

	function markRead($message_id)
	{
		// 		echo $message_id;
		// 		die();
		$this->db->where('contact_id',$message_id);
		$this->db->update('contact',array('contact_isread'=>'1'));
	}
}
