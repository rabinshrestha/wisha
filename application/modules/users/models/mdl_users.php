<?php

defined('BASEPATH') or die('Direct access is not allowed');

class Mdl_Users extends MY_Model {

	function __construct() {
		parent::__construct();
		$this->table_name = 'login';
		$this->primary_key = 'login_id';
	}

	function getUserList($page = '', $cond) {
		$this->db->where($cond);
		$this->db->select('SQL_CALC_FOUND_ROWS *', false);
		//$this->db->limit('1');
		$this->db->from($this->table_name);
		if ($page != '')
			$this->db->limit($page['limit'], $page['limitstart']);
		$result = $this->db->get();

		//echo $this->db->last_query();
		$users['users'] = $result->result();
		$rs = $this->db->query('select FOUND_ROWS() AS total');
		$total_arr = $rs->row();
		$users['total'] = $total_arr->total;
		return $users;
	}

	function getUserDetails($user_id) {
// 		echo 'user id:'.$user_id;
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('login_id',$user_id);
		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			//         	echo 'inside if';
			//         	die();
			return $result->row_array();
		} else {
			$details = array();
			$details['login_firstname'] = '';
			$details['login_lastname'] = '';
			$details['login_email'] = '';
			$details['login_pass'] = '';
			$details['login_name'] = '';
			$details['login_id'] = '';
			return $details;
		}
	}

	function checkUserField($field, $value, $user_id) {
		$this->db->select('COUNT(user_id) AS cnt');
		$this->db->from($this->table_name);
		$this->db->where($field, $value);
		$this->db->where('user_id !=', $user_id);
		$result = $this->db->get();
		$user = $result->row();
		//echo $this->db->last_query();
		return $user->cnt;
	}

	function delete($params) {
		$this->db->where('login_id !=', $this->session->userdata('user_id'));
		//$params['global_admin'] = 0;
		return parent::delete($params);
	}

	function getBoatSize() {
		$query = $this->db->get("cmb_boat_size");
		return $query->result();
	}

	function getExpSailingList() {
		$this->db->where('status', 1);
		$query = $this->db->get("cmb_sailing");
		return $query->result();
	}

	function getExpWaterList() {
		$this->db->where('status', 1);
		$query = $this->db->get("cmb_water");
		return $query->result();
	}

	function getExpFishList() {
		$this->db->where('status', 1);
		$query = $this->db->get("cmb_fishing");
		return $query->result();
	}

	function getCrewActs($userid) {
		$this->db->where("users_id", $userid);
		$query = $this->db->get("cmb_crew_activity");
		return $query->result();
	}

	function getRadius_owner() {
		$query = $this->db->get("cmb_radius");
		return $query->result();
	}

	function getRadius_crew() {
		$query = $this->db->get("cmb_radius_crew");
		return $query->result();
	}

	function getBoardingGears() {
		$query = $this->db->get("cmb_boarding_gear");
		return $query->result();
	}



	function deleteData($table,$cond){
		$this->db->where($cond);
		$this->db->delete($table);
	}

	function getData($table,$cond){
		$this->db->where($cond);
		$query = $this->db->get($table);
		return $query->result();
	}

}
