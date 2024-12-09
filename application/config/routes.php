<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'Home';
$route['news'] = 'Home/news';
$route['logout'] = 'Home/logout';
$route['faculty/(:any)'] = 'Home/faculty/$1';
$route['faculty_about/(:any)'] = 'Home/faculty_about/$1';
$route['faculty_mission/(:any)'] = 'Home/faculty_mission/$1';
$route['faculty_message/(:any)'] = 'Home/faculty_message/$1';
$route['institute/(:any)'] = 'Home/institute/$1';
$route['dept/(:any)'] = 'Home/department/$1';
$route['faculty_members/(:any)'] = 'Home/faculty_members/$1';
$route['faculty_member_detail/(:any)'] = 'Home/faculty_member_detail/$1';
$route['dept_about/(:any)'] = 'Home/dept_about/$1';
$route['dept_mission/(:any)'] = 'Home/dept_mission/$1';
$route['dept_message/(:any)'] = 'Home/dept_message/$1';
$route['program/(:num)'] = 'Home/program/$1';
$route['page/(:num)'] = 'Home/page/$1';
$route['colleges'] = 'Home/colleges';
$route['college_prog'] = 'Home/college_prog';
$route['news/(:any)'] = 'Home/post/$1';
$route['home/(:any)'] = 'Home/index/$1';
$route['about/(:any)'] = 'Home/about/$1';
$route['mission/(:any)'] = 'Home/mission/$1';
//$route['posts/(:any)'] = 'Home/post/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['email_request'] = 'Home/email_request';
$route['email_request_save']['post'] = 'Home/emailRequestSave';
$route['email_verify'] = 'Home/email_verify';
$route['email_verify_otp']['post'] = 'Home/verifyOTP';
$route['resend_otp']['post'] = 'Home/emailRequestSendOTP';
$route['email_pdf/(:any)'] = 'Home/generateFPDF/$1';
$route['email_request_status'] = 'Home/email_request_status';
