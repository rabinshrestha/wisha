<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome_model extends CI_Model {
	function get_all_data()
	{
		return $this->db->get('article')->result();
	}
}