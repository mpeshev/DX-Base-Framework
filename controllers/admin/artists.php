<?php

namespace Admin\Controllers;

class Artists_Controller extends Admin_Controller {

	protected $layout = 'default.php';

	public function __construct() {
		parent::__construct( get_class(), 'artist', '/views/admin/artists/' );
		// $this->model = new \Models\Artist();
// 		echo "Artist Controller created<br />";
	}

	public function add() {
		if ( isset( $_POST['name'] ) ) {
			$rows = $this->model->add( array( 'name' => $_POST['name'], 'country' => $_POST['country'] ) );
			
			var_dump($rows);
		} 
		
		$template_file = DX_ROOT_DIR . $this->views_dir . 'add.php';
		
		include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
	}

	public function index() {
		echo "index for admin artists() <br />";
		
		$artists = $this->model->find();
		
		foreach( $artists as $artist ) {
			echo "<p>{$artist['name']}</p>";
		}
	}
}