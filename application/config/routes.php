<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//======================= Route Auth ===================================
$route['register']                        = 'auth/register';
$route['login']        	                  = 'auth/login';
$route['logout'] 	                        = 'auth/logout';
$route['verify/(:any)/(:any)']	          = 'auth/verify_register/$1/$2';
$route['forgot'] 	= 'auth/forgot_password';
$route['verify_forgot/(:any)/(:any)']     = 'auth/verify_forgot/$1/$2';
//=====================================================================

//======================= Route API ===================================
$route['kirim_register']['POST']          ='auth/send_register';
$route['kirim_login']['POST']        	    = 'auth/send_login';
//=====================================================================

$route['admin'] = 'auth/administrator';
$route['admin/chart'] = 'chart';


//======================= Route Confide Feature ================================
$route['details/(:any)'] = 'confide/view_post/$1';
$route['settings']  = 'user/settings';
$route['search']  = 'auth/search';
$route['feedback'] = 'auth/view_feedback';
$route['(:any)']	    = 'user/view/$1';
$route['user/(:any)']   = 'user/views/$1';
$route['edit/(:any)/(:any)'] 	= 'confide/update_confide/$1/$2';
$route['users/updatephoto/(:any)/(:any)'] 	= 'confide/update_confidePhoto/$1/$2';
$route['users/updatevideo/(:any)/(:any)'] 	= 'confide/update_confideVideo/$1/$2';
$route['delete/(:any)'] 			= 'confide/delete_confide/$1';
//==============================================================================


//======================= Route Chat Feature ===================================
$route['chat/(:any)'] = 'confide/viewchat/$1';
//==============================================================================

//======================= Route Default ========================================
$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//==============================================================================
