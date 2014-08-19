<?php

namespace Controllers;

class Master_Controller {
	
	protected $layout = 'default.php';
	
	protected $views_dir =  '/views/master/';
	
	protected $model = null;
	
	protected $class_name = null;
	
	protected $logged_user = array();
	
	public function __construct( $class_name = '\Controllers\Master_Controller', $model = 'master', $views_dir = '/views/master/' ) {
		// Get caller classes
		$this->class_name = $class_name;
		
		$this->model = $model;
		$this->views_dir = $views_dir;
		
// 		$this_class = get_class();
// 		$called_class = get_called_class();
		
// 		if( $this_class !== $called_class ) {
// 			var_dump( $called_class );
// 		}
		
		include_once DX_ROOT_DIR . "models/{$model}.php";
		$model_class = "\Models\\" . ucfirst( $model ) . "_Model";  
		
		$this->model = new $model_class( array( 'table' => 'none' ) );
		
		$logged_user = \Lib\Auth::get_instance()->get_logged_user();
		$this->logged_user = $logged_user;
	}
	
	public function home() {
		$template_file = DX_ROOT_DIR . $this->views_dir . 'home.php';
		
		include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
	}
	
	public function index() {
		echo "Default view from Master_Controller <br />";
	}
	
}