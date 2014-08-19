<?php

// Define root dir and root path
define( 'DX_DS', DIRECTORY_SEPARATOR );
define( 'DX_ROOT_DIR', dirname( __FILE__ ) . DX_DS );
define( 'DX_ROOT_PATH', basename( dirname( __FILE__ ) ) . DX_DS );
define( 'DX_ROOT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/cframe/' );

// Bootstrap
include 'config/bootstrap.php';

// Define the request home that will always persist in REQUEST_URI
$request_home = DX_DS . DX_ROOT_PATH;

// Read the request
$request = $_SERVER['REQUEST_URI'];
$components = array();
$controller = 'Master';
$method = 'index';
$admin_routing = false;
$param = array();

include_once 'lib/database.php';
include_once 'lib/auth.php';

include_once 'controllers/master_controller.php';

$master_controller = new \Controllers\Master_Controller();


if ( ! empty( $request ) ) {
	if( 0 === strpos( $request, $request_home ) ) {
		// Clean the request
		$request = substr( $request, strlen( $request_home ) );
		
		
		// Switch to admin routing
		if( 0 === strpos( $request, 'admin' ) ) {
			$admin_routing = true;
			include_once 'controllers/admin/admin_controller.php';
			$request = substr( $request, strlen( 'admin/' ) );
		}
		
		
		// Fetch the controller, method and params if any
		$components = explode( DX_DS, $request, 3 );

		// Get controller and such
		if ( 1 < count( $components ) ) {
			list( $controller, $method ) = $components;
			
			$param = isset( $components[2] ) ? $components[2] : array();
		}
	}
}

// If the controller is found
if ( isset( $controller ) && file_exists( 'controllers/' . $controller . '.php' ) ) {
	$admin_folder = $admin_routing ? 'admin/' : '';
	include_once 'controllers/' . $admin_folder . $controller . '.php';
	
	// Is admin controller?
	$admin_namespace = $admin_routing ? '\Admin' : '';
	
	// Form the controller class
	$controller_class = $admin_namespace . '\Controllers\\' . ucfirst( $controller ) . '_Controller';

	$instance = new $controller_class();
	
	// Call the object and the method
	if( method_exists( $instance, $method ) ) {
		call_user_func_array( array( $instance, $method ), array( $param ) );
		
// 		$instance->$method();
	} else {
		// fallback to index
		call_user_func_array( array( $instance, 'index' ), array() );
	}
} else {

	$master_controller->home();
}
// \Lib\Auth::get_instance()->logout();

// TEST PLAYGROUND
/* include_once 'models/artist.php';

$artist_model = new \Models\Artist_Model();

$artists = $artist_model->find();

var_dump( $artists );
*/

// include_once 'lib/auth.php';
// $auth = \Lib\Auth::get_instance();

// $logged_in = $auth->login( 'test', 'test' );

// var_dump($logged_in);

// var_dump($_SESSION);