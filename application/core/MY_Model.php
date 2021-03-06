<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class MY_Model extends CI_Model {

	public $table_name;

	public $primary_key;

	public $joins;

	public $select_fields;

	public $total_rows;

	public $page_links;

	public $current_page;

	public $num_pages;

	public $optional_params;

	public $order_by;

	public $form_values = array();

	public function __construct() {

		parent::__construct();

	}

	public function form_value($var) {

		if (isset($this->form_values[$var])) {

			return $this->form_values[$var];

		}

		return '';

	}

	public function set_form_value($key, $value) {

		$this->form_values[$key] = $value;

	}

	public function query($params = NULL) {

		$this->_prep_params($params);

		$this->_prep_joins($params);

		return $this->db->get($this->table_name);

	}

	public function get($params = NULL) {

		// prepare the query segments
		$this->_prep_params($params);

		// set up the joins
		$this->_prep_joins($params);

		// execute the query
		$query = $this->db->get($this->table_name);

		if (isset($params['debug']) and $params['debug'] == TRUE) {

			echo $this->db->last_query();

			exit;

		}

		$this->_prep_pagination($params);

		if (isset($params['where']) and is_array($params['where']) and isset($params['where'][$this->primary_key])) {

			// return a single row if the primary key exists in the where element
			return $query->row();

		}

		elseif (isset($params['return_row']) and $params['return_row'] == TRUE) {

			return $query->row();

		}

		else {

			// otherwise return a full result set
			return $query->result();

		}

	}

	public function get_by_id($id) {

		$this->db->where($this->primary_key, $id);

		$this->_prep_joins();

		$query = $this->db->get($this->table_name);

		return $query->row();

	}

	public function save($db_array, $id=NULL, $set_flashdata = TRUE) {



		$success = FALSE;
		if($this->table_name != 'login')
		{
			$list_url_array = array(
					'list_url_fr' => $db_array[$this->table_name.'_slug'],
					'list_url_de' => $db_array[$this->table_name.'_slug_de']
			);
		}

		if ( $id) {
			// 			echo ' update required. id: '.$id;
			// 			die();

			if($this->table_name != 'login')
			{
				//update slug into list_url table
				// get previous slug value
				$this->db->select($this->table_name.'_slug');
				$this->db->from($this->table_name);
				$this->db->where($this->primary_key,$id);
				$reslult =  $this->db->get();
				$row = $reslult->row_array();
				// 			print_r($row)
				// 			die();
				$this->db->where('list_url_fr', $row[$this->table_name.'_slug']);
				$this->db->update('list_url',$list_url_array);
				// 			die();
			}
			$this->db->where($this->primary_key, $id);
			$success = $this->db->update($this->table_name, $db_array);
		}

		else {
			// 			echo 'insert required. id: '.$id;
			// 			die();

			$success = $this->db->insert($this->table_name, $db_array);
			if($this->table_name != 'login')
			{
				// insert slug into list_url table
				$this->db->insert('list_url',$list_url_array);
			}
		}

		if ($set_flashdata) {

			//$this->session->set_flashdata('success_save', TRUE);

		}

		return $success;

	}

	public function delete($params, $set_flashdata = TRUE) {

		if(($this->table_name != 'login') && ($this->table_name != 'contact' ))
		{
			// delete entry for list_url
			$this->db->select($this->table_name.'_slug');
			$this->db->from($this->table_name);
			foreach ($params as $field=>$value) {
				$this->db->where($field, $value);
			}
			// 		$this->db->where($params[$this->table_name.'_id'],$id);
			$reslult =  $this->db->get();
			$row = $reslult->row_array();
			// 		print_r($row);
			// 		die();

			$this->db->where('list_url_fr', $row[$this->table_name.'_slug']);
			$this->db->delete('list_url');

		}
		foreach ($params as $field=>$value) {
			$this->db->where($field, $value);
		}

		$this->db->delete($this->table_name);

		return $this->db->affected_rows();
		if ($set_flashdata) {

			//$this->session->set_flashdata('success_delete', TRUE);

		}

	}

	public function delete_image($params) {

		$this->db->select();
		$this->db->from($this->table_name);
		foreach ($params as $field=>$value) {
			$this->db->where($field, $value);
		}
		$reslult =  $this->db->get();
		$row = $reslult->row_array();
		$folder_name = '';

		if($this->table_name == 'fruit')
		{
			$folder_name = 'fruits';
		}
		else if($this->table_name == 'variety')
		{
			$folder_name = 'variety';
		}
		else if($this->table_name == 'recipe')
		{
			$folder_name = 'recipe';
		}
		else if($this->table_name == 'producer')
		{
			$folder_name = 'producers';
			$image_name  ='';
			$var = 1;
			for($var=1;$var<=5;$var++)
			{
				$image_name = $row[$this->table_name.'_image'.$var];
				@unlink('./assets/uploads/'.$folder_name.'/'.$image_name);
				@unlink('./assets/uploads/'.$folder_name.'/_thumbs/'.$image_name);

			}
			return TRUE;
		}

		// 		if($params)
		$image_name = $row[$this->table_name.'_image'];
		// delete image

		@unlink('./assets/uploads/'.$folder_name.'/'.$image_name);
		@unlink('./assets/uploads/'.$folder_name.'/_thumbs/'.$image_name);


	}

	public function delete_by_id($id, $set_flashdata = TRUE) {

		$this->db->where($this->primary_key, $id);

		$this->db->delete($this->table_name);

		if ($set_flashdata) {

			$this->session->set_flashdata('success_delete', TRUE);

		}

	}

	private function _prep_params($params = NULL) {

		if (isset($params['select'])) {

			$this->db->select($params['select'], FALSE);

		}

		elseif (isset($this->select_fields)) {

			$this->db->select($this->select_fields, FALSE);

		}

		if (isset($params['where'])) {

			if (is_array($params['where'])) {

				foreach ($params['where'] as $key=>$value) {

					if ($key) {

						$this->db->where($key, $value);

					}

					else {

						$this->db->where($value);

					}

				}

			}

			else {

				$this->db->where($params['where']);

			}

		}

		if (isset($params['having'])) {

			if (is_array($params['having'])) {

				foreach ($params['having'] as $key=>$value) {

					if ($key) {

						$this->db->having($key, $value);

					}

					else {

						$this->db->having($value);

					}

				}

			}

			else {

				$this->db->having($params['having']);

			}

		}

		if (isset($params['like'])) {

			if (is_array($params['like'])) {

				foreach ($params['like'] as $key=>$value) {

					$this->db->where('(' . $key . " LIKE " . $this->db->escape('%' . $value . '%') . " or " . $key . " LIKE " . $this->db->escape($value . '%') . ")");

				}

			}

			else {

				$this->db->like($params['like']);

			}

		}

		if (isset($params['where_in'])) {

			if (is_array($params['where_in'])) {

				foreach ($params['where_in'] as $key=>$value) {

					$this->db->where_in($key, $value);

				}

			}

			else {

				$this->db->where_in($params['where_in']);

			}

		}

		elseif (isset($this->where_in)) {

			if (is_array($this->where_in)) {

				foreach ($this->where_in as $key=>$value) {

					$this->db->where_in($key, $value);

				}

			}

			else {

				$this->db->where_in($this->where_in);

			}

		}

		// should the results be paginated?
		if (isset($params['paginate']) AND $params['paginate'] == TRUE AND (isset($params['limit']) OR isset($this->limit))) {

			$this->offset = (isset($params['page'])) ? $params['page'] : 0;

			$this->limit = (isset($params['limit'])) ? $params['limit'] : $this->limit;

			$this->db->limit($this->limit, $this->offset);

		}

		elseif (isset($params['limit']) AND (!isset($params['paginate']) OR $params['paginate'] == FALSE)) {

			$this->db->limit($params['limit']);

		}

		if (isset($params['order_by'])) {

			$this->db->order_by($params['order_by']);

		}

		elseif (isset($this->order_by)) {

			$this->db->order_by($this->order_by);

		}

		if (isset($params['group_by'])) {

			$this->db->group_by($params['group_by']);

		}

		elseif (isset($this->group_by)) {

			$this->db->group_by($this->group_by);

		}

		// are there any optional parameters?

		if (isset($params) AND isset($this->optional_params)) {

			foreach ($this->optional_params as $key=>$param) {

				if (key_exists($key, $params)) {

					$method = $this->optional_params[$key]['method'];

					$clause = $this->optional_params[$key]['clause'];

					$this->db->$method($clause);

				}

			}

		}

	}

	private function _prep_pagination($params) {

		if (isset($params['paginate']) AND $params['paginate'] == TRUE) {

			$query = $this->db->query('SELECT FOUND_ROWS() AS total_rows');

			$this->total_rows = $query->row()->total_rows;

			$this->load->library('pagination');

			if (!isset($this->page_config)) {

				$config = array(
						'base_url'			=>	$this->_base_url(),
						'total_rows'		=>	$this->total_rows,
						'per_page'			=>	$this->limit,
						'next_link'			=>	$this->lang->line('next') . ' >',
						'prev_link'			=>	'< ' . $this->lang->line('prev'),
						'cur_tag_open'		=>	'<span class="active_link">',
						'cur_tag_close'		=>	'</span>',
						'num_links'			=>	3
				);

			}

			else {

				$config = $this->page_config;

			}

			$config['base_url'] = $this->_base_url();
			$config['total_rows'] = $this->total_rows;
			$config['per_page'] = $this->limit;
			$config['cur_page'] = $this->offset;

			$this->pagination->initialize($config);
			$this->page_links = $this->pagination->create_links();
			$this->current_page = ($this->offset / $this->limit) + 1;
			$this->num_pages = ceil($this->total_rows / $this->limit);

		}

	}

	private function _base_url() {

		// strips the page segment and re-adds it to the end
		// for use in CI pagination library for base_url

		$uri_segments = $this->uri->uri_string();

		$uri_segments = explode('/', $uri_segments);

		if (!isset($this->page_links_no_index)) {
			// add the index segment to the end of the array if it does not exist
			if (!in_array('index', $uri_segments, TRUE)) {

				$uri_segments[] = 'index';

			}
		}

		foreach ($uri_segments as $key=>$value) {

			if ($value == 'page') {

				unset($uri_segments[$key], $uri_segments[$key + 1]);

			}

		}

		$uri_segments[] = 'page';

		return site_url(implode('/', $uri_segments));

	}

	private function _prep_joins($params = NULL) {

		if (isset($params['joins'])) {

			$joins = $params['joins'];

		}

		elseif (isset($this->joins)) {

			$joins = $this->joins;

		}

		if (isset($joins)) {

			foreach ($joins as $table=>$join) {

				if (is_array($join)) {

					$this->db->join($table, $join[0], $join[1]);

				}

				else {

					$this->db->join($table, $join);

				}

			}

		}

	}

	public function db_array() {

		$db_array = array();

		$field_data = $this->form_validation->_field_data;

		foreach (array_keys($field_data) as $field) {

			if (isset($_POST[$field])) {

				$db_array[$field] = $this->input->post($field, TRUE);

			}

		}

		return $db_array;

	}

	public function prep_validation($id) {

		// this function will return the initial values to populate a form on an edit

		$result = $this->get(array('where'=>array($this->primary_key=>$id)));

		foreach ($result as $key=>$value) {

			$this->form_values[$key] = $value;

		}

	}

	public function validate($obj = NULL) {

		foreach ($_POST as $key=>$value) {

			$this->form_values[$key] = $value;

		}

		if ($obj) {

			return $this->form_validation->run($obj);

		}

		else {

			return $this->form_validation->run();

		}

	}

	public function show($var) {

		echo "<pre>";

		print_r($var);

		echo "</pre>";

	}

}

?>