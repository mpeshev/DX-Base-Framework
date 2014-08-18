<?php

namespace Models;

class Artist_Model extends \Models\Master_Model {

	public function __construct( $args = array() ) {
		parent::__construct( array(
			'table' => 'artists'
		) );
// 		echo "Artist model <br />";
	}
	
	public function get_artists() {
		return parent::find( );
	}
}