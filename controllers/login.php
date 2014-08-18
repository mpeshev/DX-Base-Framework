<?php

namespace Controllers;

class Login_Controller extends Master_Controller {
	
	public function __construct() {
		parent::__construct( get_class(), 'master', '/views/login/' );
		
		// $this->model = new \Models\Artist();
		echo "Login Controller created<br />";
	}
	
	public function index() {
		$auth = \Lib\Auth::get_instance();
		
		$login_text = '';
		$username = $auth->get_username();
		
		if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
			
			$logged_in = $auth->login( $_POST['username'], $_POST['password'] );
			
			if ( ! $logged_in ) {
				$login_text = 'Login not successful.';
			} else {
				$login_text = 'Login was successful!';
			}
		}
		
		$template_file = DX_ROOT_DIR . $this->views_dir . 'login.php';
		
		include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
	}
}