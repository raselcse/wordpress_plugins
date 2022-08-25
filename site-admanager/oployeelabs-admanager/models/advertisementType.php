<?php
class AdvertisementType extends OplModel{
    
    public function __construct(){
     	
		parent::__construct();
		
    }
	
    public function save_type($table , $data){
		
		return $this->save_opl($table , $data);
	}
	
	public function getAll_type($table){
		return $this->getAll_opl($table);
	}
	
	public function getField_type($table,$fieldName){
		return $this->getField_opl($table,$fieldName);
	}
	
	public function getById_type($table,$id){
		return $this->getById_opl($table ,$id);
	}
	
	public function deleteById_type($table,$id){
		return $this->deleteById_opl($table , $id);
	}
	
	public function update_type($table,$data,$id){
		return $this->update_opl($table,$data,$id);
	}
}