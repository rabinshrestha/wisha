<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 | -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


// routes for home page
$route['default_controller'] = 'cms/home';


// $route['about/'] = 'en/about';

$route['admin'] = 'admin/login';
$route['admin/login'] = 'admin/login';
$route['admin/logout'] = 'admin/logout';
$route['admin/attributes/([a-zA-Z_-]+)/create'] = 'admin/attributes/create/$1';
$route['admin/attributes/([a-zA-Z_-]+)/edit'] = 'admin/attributes/edit/$1';
$route['admin/([a-zA-Z_-]+)/(:any)'] = '$1/admin/$2';
$route['admin/([a-zA-Z_-]+)'] = '$1/admin/index';


// routes for administrator
//$route['admin'] = '/admin/home';


// routes for fruit
// $route['les-fruits'] = 'fruit';
// $route['fruit'] = 'fruit';
// $route['fruit/(:any)'] = 'fruit/view/$1';


// // route for contact
// $route['contact'] = 'contact';




// for language liabrary
// example: '/en/about' -> use controller 'about'

// for home page routing
$route['^fr/(le-concept-wisha)'] = 'cms/home/concept';
$route['^de/das-konzept-wisha'] = 'cms/home/concept';

// for fruit
$route['^fr/les-fruits'] = 'fruit/fruit';
$route['^de/fruchte'] = 'fruit/fruit';

// for contact
$route['^fr/contact'] = 'contact/contact';
$route['^de/kontakt'] = 'contact/contact';
$route['^(de|fr)/(kontakt|contact)/sucess'] = 'contact/contact/sucess';

// for project
$route['^fr/les-projects-sociaux'] = 'cms/home/project';
$route['^de/soziale-projekte'] = 'cms/home/project';


// for recipe
$route['^fr/les-recettes'] = 'recipe/recipe';
$route['^de/rezepte'] = 'recipe/recipe';

$route['^fr/les-recettes/(:any)'] = 'recipe/recipe/url_master';
$route['^de/rezepte/(:any)'] = 'recipe/recipe/url_master';


// // '/en' and '/fr' -> use default controller
$route['^fr$'] = $route['default_controller'];
$route['^de$'] = $route['default_controller'];


// // defined for recipe
// $route['^(fr|de)/(:any)'] = "fruit/fruit/url_master";

// defined for fruit
$route['^(fr|de)/(:any)'] = "fruit/fruit/url_master";



// $route['^fr/(.+)$'] = "$1";
// $route['^de/(.+)$'] = "$1";

// for home
// $route['home'] = 'cms/home';
// $route['le-concept-wisha'] = 'cms/home/concept';
// $route['les-projets-sociaux'] = 'cms/home/project';

// $route['(:any)'] = 'home/test/$1';
// routes for administrator
// $route['admin'] = 'admin';
// $route['admin/login'] = 'admin/home/login';
// $route['admin/(:any)'] = 'admin/home/$1';



// $route['404_override'] = '';
//$route['default_controller'] = "welcome";
//$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */