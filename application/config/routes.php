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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['dailydip/'] = 'Dailydip/index';
$route['dailydip/insert'] = 'Dailydip/formview';
$route['dailydip/update/(:num)'] = 'Dailydip/edit/$1';
$route['dailydip/save'] = 'Dailydip/create';
$route['dailydip/edit/(:num)'] = 'Dailydip/formupdate/$1';
$route['dailydip/delete/(:num)'] = 'Dailydip/delete/$1';
$route['documents/'] = 'Documents/index';
$route['documents/insert'] = 'Documents/formview';
$route['documents/update/(:num)'] = 'Documents/edit/$1';
$route['documents/save'] = 'Documents/create';
$route['documents/edit/(:num)'] = 'Documents/formupdate/$1';
$route['documents/delete/(:num)'] = 'Documents/delete/$1';
$route['employee/'] = 'Employee/index';
$route['employee/insert'] = 'Employee/formview';
$route['employee/update/(:num)'] = 'Employee/edit/$1';
$route['employee/save'] = 'Employee/create';
$route['employee/edit/(:num)'] = 'Employee/formupdate/$1';
$route['employee/delete/(:num)'] = 'Employee/delete/$1';
$route['employeetype/'] = 'Employeetype/index';
$route['employeetype/insert'] = 'Employeetype/formview';
$route['employeetype/update/(:num)'] = 'Employeetype/edit/$1';
$route['employeetype/save'] = 'Employeetype/create';
$route['employeetype/edit/(:num)'] = 'Employeetype/formupdate/$1';
$route['employeetype/delete/(:num)'] = 'Employeetype/delete/$1';
$route['fillingstation/'] = 'Fillingstation/index';
$route['fillingstation/insert'] = 'Fillingstation/formview';
$route['fillingstation/update/(:num)'] = 'Fillingstation/edit/$1';
$route['fillingstation/save'] = 'Fillingstation/create';
$route['fillingstation/edit/(:num)'] = 'Fillingstation/formupdate/$1';
$route['fillingstation/delete/(:num)'] = 'Fillingstation/delete/$1';
$route['location/'] = 'Location/index';
$route['location/insert'] = 'Location/formview';
$route['location/update/(:num)'] = 'Location/edit/$1';
$route['location/save'] = 'Location/create';
$route['location/edit/(:num)'] = 'Location/formupdate/$1';
$route['location/delete/(:num)'] = 'Location/delete/$1';
$route['loginlog/'] = 'Loginlog/index';
$route['loginlog/insert'] = 'Loginlog/formview';
$route['loginlog/update/(:num)'] = 'Loginlog/edit/$1';
$route['loginlog/save'] = 'Loginlog/create';
$route['loginlog/edit/(:num)'] = 'Loginlog/formupdate/$1';
$route['loginlog/delete/(:num)'] = 'Loginlog/delete/$1';
$route['materialprice/'] = 'Materialprice/index';
$route['materialprice/insert'] = 'Materialprice/formview';
$route['materialprice/update/(:num)'] = 'Materialprice/edit/$1';
$route['materialprice/save'] = 'Materialprice/create';
$route['materialprice/edit/(:num)'] = 'Materialprice/formupdate/$1';
$route['materialprice/delete/(:num)'] = 'Materialprice/delete/$1';
$route['orderitems/'] = 'Orderitems/index';
$route['orderitems/insert'] = 'Orderitems/formview';
$route['orderitems/update/(:num)'] = 'Orderitems/edit/$1';
$route['orderitems/save'] = 'Orderitems/create';
$route['orderitems/edit/(:num)'] = 'Orderitems/formupdate/$1';
$route['orderitems/delete/(:num)'] = 'Orderitems/delete/$1';
$route['orders/'] = 'Orders/index';
$route['orders/insert'] = 'Orders/formview';
$route['orders/update/(:num)'] = 'Orders/edit/$1';
$route['orders/save'] = 'Orders/create';
$route['orders/edit/(:num)'] = 'Orders/formupdate/$1';
$route['orders/delete/(:num)'] = 'Orders/delete/$1';
$route['paymentmethod/'] = 'Paymentmethod/index';
$route['paymentmethod/insert'] = 'Paymentmethod/formview';
$route['paymentmethod/update/(:num)'] = 'Paymentmethod/edit/$1';
$route['paymentmethod/save'] = 'Paymentmethod/create';
$route['paymentmethod/edit/(:num)'] = 'Paymentmethod/formupdate/$1';
$route['paymentmethod/delete/(:num)'] = 'Paymentmethod/delete/$1';
$route['payments/'] = 'Payments/index';
$route['payments/insert'] = 'Payments/formview';
$route['payments/update/(:num)'] = 'Payments/edit/$1';
$route['payments/save'] = 'Payments/create';
$route['payments/edit/(:num)'] = 'Payments/formupdate/$1';
$route['payments/delete/(:num)'] = 'Payments/delete/$1';
$route['users/'] = 'Users/index';
$route['users/insert'] = 'Users/formview';
$route['users/update/(:num)'] = 'Users/edit/$1';
$route['users/save'] = 'Users/create';
$route['users/edit/(:num)'] = 'Users/formupdate/$1';
$route['users/delete/(:num)'] = 'Users/delete/$1';
$route['vehicle/'] = 'Vehicle/index';
$route['vehicle/insert'] = 'Vehicle/formview';
$route['vehicle/update/(:num)'] = 'Vehicle/edit/$1';
$route['vehicle/save'] = 'Vehicle/create';
$route['vehicle/edit/(:num)'] = 'Vehicle/formupdate/$1';
$route['vehicle/delete/(:num)'] = 'Vehicle/delete/$1';
$route['vehicle_calibration_certificate/'] = 'Vehicle_calibration_certificate/index';
$route['vehicle_calibration_certificate/insert'] = 'Vehicle_calibration_certificate/formview';
$route['vehicle_calibration_certificate/update/(:num)'] = 'Vehicle_calibration_certificate/edit/$1';
$route['vehicle_calibration_certificate/save'] = 'Vehicle_calibration_certificate/create';
$route['vehicle_calibration_certificate/edit/(:num)'] = 'Vehicle_calibration_certificate/formupdate/$1';
$route['vehicle_calibration_certificate/delete/(:num)'] = 'Vehicle_calibration_certificate/delete/$1';
$route['vehicle_revenue_license/'] = 'Vehicle_revenue_license/index';
$route['vehicle_revenue_license/insert'] = 'Vehicle_revenue_license/formview';
$route['vehicle_revenue_license/update/(:num)'] = 'Vehicle_revenue_license/edit/$1';
$route['vehicle_revenue_license/save'] = 'Vehicle_revenue_license/create';
$route['vehicle_revenue_license/edit/(:num)'] = 'Vehicle_revenue_license/formupdate/$1';
$route['vehicle_revenue_license/delete/(:num)'] = 'Vehicle_revenue_license/delete/$1';
$route['vehicle_type'] = 'Vehicletype/index';
$route['vehicle_type/insert'] = 'Vehicletype/formview';
$route['vehicle_type/update/(:num)'] = 'Vehicletype/edit/$1';
$route['vehicle_type/save'] = 'Vehicletype/create';
$route['vehicle_type/edit/(:num)'] = 'Vehicletype/formupdate/$1';
$route['vehicle_type/delete/(:num)'] = 'Vehicletype/delete/$1';
$route['register'] = 'Login/register';
$route['register/add'] = 'Login/registeruser';
$route['login/auth'] = 'Login/checklogin';
$route['logout'] = 'Login/logout';
$route['dashboard'] = 'Dashboard/dashboard';
$route['fuelstations/list/unapproved'] = 'Fillingstation/unapprovallist';
$route['fillingstation/view/doc/(:num)'] = 'Fillingstation/unapprovallistbyid/$1';
$route['fillingstation/approve/(:num)'] = 'Fillingstation/approve/$1';
$route['dailydip/markdip/(:num)'] = 'Dailydip/markdip/$1';
$route['dailydip/markdip/save'] = 'Dailydip/markdipsave';
$route['employee/register'] = 'Employee/applyasemployee';
$route['employee/register/save'] = 'Employee/employeesave';
$route['fuelorders/placeorder'] = 'Orders/placeorders';
$route['vehicle/register'] = 'Vehicle/vehicleregistration';
$route['vehicle/register/save'] = 'Vehicle/vehicleregistrationsave';
$route['vehicle/certificate/calibration'] = 'Vehiclecalibrationcertificate/vehiclecertification';
$route['vehicle/certificate/calibration/save'] = 'Vehiclecalibrationcertificate/vehiclecertificatesave';
$route['vehicle/certificate/revenuelicesen'] = 'Vehiclerevenuelicense/vehiclerevenueform';
$route['vehicle/certificate/revenuelicesen/save'] = 'Vehiclerevenuelicense/vehiclerevenueformsave';
$route['fuelorders/placeorder/save'] = 'Orders/placeorderssave';



