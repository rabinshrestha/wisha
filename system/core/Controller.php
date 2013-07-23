<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
*/

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
*/
class CI_Controller {

	private static $instance;
	public $current_lang = '';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();

		log_message('debug', "Controller Class Initialized");

		if($this->lang->lang() == 'fr')
		{
			$this->current_lang = '';
		}

		else
		{
			$this->current_lang = '_de';
		}
		/*
		 if($this->session->userdata('user_lang') == FALSE)
		 {
		$this->session->set_userdata('user_lang','fr');
		}

		$uri_segment = $this->uri->segment(1);
		if($uri_segment == 'fr')
		{
		$this->session->set_userdata('user_lang','fr');
		MY_Lang::$current_lang = 'fr';
		}
		else if($uri_segment == 'de')
		{
		$this->session->set_userdata('user_lang','de');
		MY_Lang::$current_lang = 'de';
		}
		*/
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */