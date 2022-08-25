<?php
Class Ds_model extends Ds_database{
	
	public function __construct(){
     	parent::__construct();
     }
	public function save_opl($table , $data){
		 global $wpdb;
		 $table = $wpdb->prefix.$table;
		return $wpdb->insert($table , $data);
	}
	
	public function getAll_opl($table){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "SELECT * FROM $table";
		return $wpdb->get_results($sql);
	}
	public function getAllWithOrder_opl($table,$orderField,$orderValue){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "SELECT * FROM $table ORDER BY $orderField $orderValue";
		return $wpdb->get_results($sql);
	}
    
	public function getField_opl($table,$fieldName){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "SELECT $fieldName FROM $table";
		return $wpdb->get_results($sql);
	}

	public function getFieldById_opl($table,$fieldName,$id){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "SELECT $fieldName FROM $table WHERE id=$id";
		return $wpdb->get_results($sql);
	}
	
	public function getById_opl($table,$id){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "SELECT * FROM $table WHERE id=$id";
		return $wpdb->get_results($sql);
	}

	public function getByWhere_opl($table ,$field , $value){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "SELECT * FROM $table WHERE $field = $value";
		return $wpdb->get_results($sql);
	}
	
	public function getByFieldOrderWhere_opl($table ,$field , $value,$orderField,$order_value){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "SELECT * FROM $table WHERE $field = $value ORDER BY $orderField $order_value ";
		return $wpdb->get_results($sql);
	}

	public function deleteById_opl($table,$id){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		return $wpdb->delete( $table, array( 'id' => $id ));
	}
	
	public function update_opl($table,$data,$id){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		return $wpdb->update($table, $data, array('id'=>$id));
	}
}