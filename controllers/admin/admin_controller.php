<?php

namespace Admin\Controllers;

class Admin_Controller extends \Controllers\Master_Controller {
	
	public function __construct( $class_name = '\Controllers\Master_Controller', $model = 'master', $views_dir = '/views/master/' ) {
		parent::__construct( get_class(), $model, $views_dir );
		
		$logged_in = \Lib\Auth::get_instance()->validate_session();
		
		if( ! $logged_in ) {
			header( 'Location: http://' . DX_ROOT_URL . $_SERVER['PHP_SELF'] );
			exit();
		}
	}
}