<?php

namespace Lib;

class Database {
	
	private static $db = null;
	
	private function __construct() {
		var_dump('Database connected. <br />');
		
		$host = 'localhost';
		$username = 'root';
		$password = '';
		$database = 'sample';
		
		$db = new \mysqli( $host, $username, $password, $database );
		
		self::$db = $db;
	}
	
	public static function get_instance() {
		static $instance = null;
		
		if( null === $instance ) {
			$instance = new static();
		}
		
		return $instance;
	}
	
	public static function get_db() {
		return self::$db;
	}
}

var_dump('db called');
