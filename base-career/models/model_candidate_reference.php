<?php
class Model_candidate_reference extends Basecareer_model{
    
    public function __construct(){
     	parent::__construct();
	}
	
    public function save($table , $data){
		return $this->save_opl($table , $data);
	}
	
	public function getAll($table){
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

	public function deleteById($table,$id){
		return $this->deleteById_opl($table , $id);
	}
	
	public function update($table,$data,$id){
		return $this->update_opl($table,$data,$id);
	}
    
	public function updateWhere($table, $data, $field, $id){
		
		return $this->updateWhere_opl($table,$data,$field,$id);
	}

}