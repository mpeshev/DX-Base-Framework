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
		} 
		
		$template_file = DX_ROOT_DIR . $this->views_dir . 'add.php';
		
		include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
	}
	
	public function edit( $id ) {
		if ( isset( $_POST['id'] ) ) {
			$artist = array(
				'id' => $_POST['id'],
				'name' => $_POST['name'],
				'country' => $_POST['country']					
			);
			$this->model->update( $artist );
			header( 'Location: ' . DX_ROOT_URL . 'admin/artists/view/' . $_POST['id'] );
			exit;
		}
		
		$artists = $this->model->get( $id );
		
		$template_file = DX_ROOT_DIR . $this->views_dir . 'edit.php';
		
		include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
	}

	public function index() {
		$artists = $this->model->find( );
		
		$template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';
		
		include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
	}
	
	public function view( $id ) {
		$artists = $this->model->get( $id );
		
		$template_file = DX_ROOT_DIR . $this->views_dir . 'index.php';
		
		include_once DX_ROOT_DIR . '/views/layouts/' . $this->layout;
	}
}