<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// CodeIgniter i18n library by Jérôme Jaglale
// http://maestric.com/en/doc/php/codeigniter_i18n
// version 10 - May 10, 2012
// include_once '../../core/MY_Lang.php.php';
// include_once '';
// require_once();


class MY_Lang extends MX_Lang {

	/**************************************************
	 configuration
	***************************************************/

	// languages
	var $languages = array(
			'fr' => 'french',
			'de' => 'german'
	);

	// special URIs (not localized)
	var $special = array ('admin');

	// where to redirect if no language in URI
	var $default_uri = '';

	/**************************************************/


	function __construct()
	{
		parent::__construct();

		global $CFG;
		global $URI;
		global $RTR;

		$segment = $URI->segment(1);

		if (isset($this->languages[$segment]))	// URI with language -> ok
		{
			$language = $this->languages[$segment];
			$CFG->set_item('language', $language);

		}
		else if($this->is_special($segment)) // special URI -> no redirect
		{
			return;
		}
		else	// URI without language -> redirect to default_uri
		{
			// set default language
			$CFG->set_item('language', $this->languages[$this->default_lang()]);

			// redirect
			header("Location: " . $CFG->site_url($this->localized($this->default_uri)), TRUE, 302);
			exit;
		}
	}

	// get current language
	// ex: return 'en' if language in CI config is 'english'
	function lang()
	{
		global $CFG;
		$language = $CFG->item('language');

		$lang = array_search($language, $this->languages);
		if ($lang)
		{
			return $lang;
		}

		return NULL;	// this should not happen
	}

	function is_special($uri)
	{
		$exploded = explode('/', $uri);
		if (in_array($exploded[0], $this->special))
		{
			return TRUE;
		}
		if(isset($this->languages[$uri]))
		{
			return TRUE;
		}
		return FALSE;
	}

	function switch_uri($lang)
	{
		$CI =& get_instance();
		$uri = urldecode($CI->uri->uri_string());
		if ($uri != "")
		{
			// 			$obj = new Fruit();
			include_once 'application/modules/cms/controllers/home.php';
			$obj = new Home();
			// 			$obj1 = new Home();

			$exploded = explode('/', $uri);
			$lenght = count($exploded);
			$i = 0;
			// 			print_r($exploded);
			// 			die();
			if($exploded[0] == $this->lang())
			{
				// 				echo 'true';
				$exploded[0] = $lang;
				// 				for($i = 1; $i <$lenght; $i++)
				// 				{
				// 					$exploded[$i] =
				// 				}



				for($i = 1; $i <$lenght; $i++)
				{
					if($lang == 'fr')
					{
						// 						echo 'inside de';
						// convert url into french language
						//check for french entries for each uri segment
						// 					$segments = $CI->uri->segment_array();
						$input['list_url_de'] = $exploded[$i];
						// 		print_r($age);
						// 		die();
						$result = $obj->get_Data($input);
						// 				 		print_r($result);
						if($result == array())
						{
							// 							echo 'no result';
							continue;
						}
						// 						echo 'from de: ';
						// 						print_r($result['list_url_fr']);
						// 						die();
						// 		$result = $obj->concept();
						// 						die();

						// 						$exploded[$i] = 'das-konzept-wisha';
						$exploded[$i] = $result['list_url_fr'];
					}
					else if($lang == 'de')
					{
						$input['list_url_fr'] = $exploded[$i];
						// 		print_r($age);
						// 		die();
						$result = $obj->get_Data($input);
						// 						echo 'from fr: ';
						// 						print_r($result);
						// 		$result = $obj->concept();

						// 						die();
						// 						$exploded[$i] = 'le-concept-wisha';
						if($result == array())
						{
							// 							echo 'no result';
							continue;
						}
						$exploded[$i] = $result['list_url_de'];

					}
					// 					echo $exploded[$i];


				}
			}
			$uri = implode('/',$exploded);
		}
		return $uri;

	}

	// is there a language segment in this $uri?
	function has_language($uri)
	{
		$first_segment = NULL;

		$exploded = explode('/', $uri);
		if(isset($exploded[0]))
		{
			if($exploded[0] != '')
			{
				$first_segment = $exploded[0];
			}
			else if(isset($exploded[1]) && $exploded[1] != '')
			{
				$first_segment = $exploded[1];
			}
		}

		if($first_segment != NULL)
		{
			return isset($this->languages[$first_segment]);
		}

		return FALSE;
	}

	// default language: first element of $this->languages
	function default_lang()
	{
		foreach ($this->languages as $lang => $language)
		{
			return $lang;
		}
	}

	// add language segment to $uri (if appropriate)
	function localized($uri)
	{
		if($this->has_language($uri)
				|| $this->is_special($uri)
				|| preg_match('/(.+)\.[a-zA-Z0-9]{2,4}$/', $uri))
		{
			// we don't need a language segment because:
			// - there's already one or
			// - it's a special uri (set in $special) or
			// - that's a link to a file
		}
		else
		{
			$uri = $this->lang() . '/' . $uri;
		}

		return $uri;
	}

}

/* End of file */
