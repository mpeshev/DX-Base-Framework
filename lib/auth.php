<?php

namespace Lib;

class Auth {
	
	private static $session = null;
	
	private function __construct() {
		session_start();
	}
	
	public static function get_instance() {
		static $instance = null;
		
		if ( null === $instance ) {
			$instance = new static();
		}
		
		return $instance;
	}
	
	public function validate_session() {
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
			$_SESSION['id'] = $row['id'];
			
			return true;
		}
		
		return false;
	}
	
	public function logout( ) {
		
	} 
	
	public function get_username() {
		if ( ! isset( $_SESSION['username'] )  ) {
			return '';
		}
		return $_SESSION['username'];
		
	}
}