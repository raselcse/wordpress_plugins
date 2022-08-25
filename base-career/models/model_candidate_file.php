<?php
class Model_candidate_file extends Basecareer_model{
    
    public function __construct(){
     	
		parent::__construct();
		
    }
	
    public function save($table , $data){
		
		return $this->save_opl($table , $data);
	}
	
	public function getAllPrescription($table){
		
		return $this->getAll_opl($table);
	}

	public function getActiveAll($table, $field, $value ){
		
		return $this->getByWhere_opl($table, $field, $value);
	}
	
	public function getById($table,$id){
		
		return $this->getById_opl($table ,$id);
	}

	public function getByWhere($table,$field,$value){
		
		return $this->getByWhere_opl($table,$field,$value);
	}
    public function fieldValueExist($table,$fieldName,$id,$value){
		global $wpdb;
		$table = $wpdb->prefix.$table;
		$sql   = "SELECT $fieldName FROM $table WHERE $id=$value";
		
		$data_list = $wpdb->get_results($sql);
		return $data_list[0]->$fieldName;

		//return $wpdb->mysql_fetch_object();	
	
	}
	public function deleteById($table,$id){
		
		return $this->deleteById_opl($table , $id);
		
	}
	
	public function update($table,$data,$id){
		
		return $this->update_opl($table,$data,$id);
	}
	
}