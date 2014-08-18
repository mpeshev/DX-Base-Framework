<?php

namespace Models;

class Master_Model {
	
	protected $table;
	protected $where;
	protected $columns;
	protected $limit;
	protected $dbconn;
	
	public function __construct( $args = array() ) {
		$args = array_merge( $args, array(
			'where' => '',
			'columns' => '*',
			'limit' => 0
		) );
		
		if ( ! isset( $args['table'] ) ) {
			die( 'Table not defined. Please define a model table.' );
		}
		
		extract( $args );
		
		$this->table = $table;
		$this->where = $where;
		$this->columns = $columns;
		$this->limit = $limit;
		
		$db = \Lib\Database::get_instance();
		$this->dbconn = $db::get_db();
	}
	
	public function get( $id ) {}
	public function add( $pairs ) {
		// Get keys and values separately
		$keys = array_keys( $pairs );
		$values = array();
		
		// Escape values, like prepared statement
		foreach( $pairs as $key => $value ) {
			$values[] = "'" . $this->dbconn->real_escape_string( $value ) . "'";	
		}
		
		$keys = implode( $keys, ',' );
		$values = implode( $values, ',' );
		
		$query = "insert into {$this->table}($keys) values($values)";
		
// 		var_dump($query);
		
		$this->dbconn->query( $query );
		
		return $this->dbconn->affected_rows;
	}
	public function delete( $element ) {}
	
	public function find( $args = array() ) {
			
		$args = array_merge( $args, array(
			'table' => $this->table,
			'where' => '',
			'columns' => '*',
			'limit' => 0
		) );
		
		extract( $args );
		
		$query = "select {$columns} from {$table}";
		
		if( ! empty( $where ) ) {
			$query .= ' where ' . $where;
		}
		
		if( ! empty( $limit ) ) {
			$query .= ' limit ' . $limit;
		}
		
		$result_set = $this->dbconn->query( $query );
		
		$results = $this->process_results( $result_set );
		
		return $results;
	}
	
	protected function process_results( $result_set ) {
		$results = array();
		
		if( ! empty( $result_set ) && $result_set->num_rows > 0) {
			while($row = $result_set->fetch_assoc()) {
				$results[] = $row;
			}
		}
		
		return $results;
	}
}