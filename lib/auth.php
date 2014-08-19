<?php

namespace Lib;

class Auth {
	
	private static $session = null;
	
	private function __construct() {
		// Session lifetime = 30min
		session_set_cookie_params(1800,"/");
		session_start();
	}
	
	public static function get_instance() {
		static $instance = null;
		
		if ( null === $instance ) {
			$instance = new static();
		}
		
		return $instance;
	}
	
	public function is_logged_in() {
		if ( isset( $_SESSION['username'] ) ) {
			return true;
		}
		return false;
	}
	
	public function login( $username, $password ) {
		$db = \Lib\Database::get_instance();
		$dbconn = $db->get_db();
		
		
		$statement = $dbconn->prepare( "SELECT id FROM users WHERE username = ? AND password = MD5( ? ) LIMIT 1" );
		$statement->bind_param( 'ss', $username, $password );
		
		$statement->execute();
		
		$result_set = $statement->get_result();
		
		if ( $row = $result_set->fetch_assoc() ) {
			$_SESSION['username'] = $username;
			$_SESSION['user_id'] = $row['id'];

			return true;
		}
		
		return false;
	}
	
	public function logout( ) {
		session_destroy();
	} 
	
	public function get_logged_user() {
		if ( ! isset( $_SESSION['username'] )  ) {
			return array();
		}
		
		return array( 
				'username' => $_SESSION['username'], 
				'user_id' => $_SESSION['user_id'] 
		);
		
	}
}