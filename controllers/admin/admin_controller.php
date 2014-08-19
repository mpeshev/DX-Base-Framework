<?php

namespace Admin\Controllers;

class Admin_Controller extends \Controllers\Master_Controller {
	
	public function __construct( $class_name = '\Controllers\Master_Controller', $model = 'master', $views_dir = '/views/master/' ) {
		parent::__construct( get_class(), $model, $views_dir );
		
		$logged_in = \Lib\Auth::get_instance()->is_logged_in();
		
		if( ! $logged_in ) {
			header( 'Location: ' . DX_ROOT_URL );
			exit();
		}
	}
}