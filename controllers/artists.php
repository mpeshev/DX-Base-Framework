<?php

namespace Controllers;

class Artists_Controller extends Master_Controller {
	
	protected $layout = 'default.php';
	
	public function __construct() {
		parent::__construct( get_class(), 'artist', '/views/artists/' );
		// $this->model = new \Models\Artist();
// 		echo "Artist Controller created<br />";
	}
	
	public function alabala() {
		echo "method ala bala<br />";
	}
	
	public function index() {
		$artists = $this->model->find();
		
		$template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';
		
		include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
	}
}