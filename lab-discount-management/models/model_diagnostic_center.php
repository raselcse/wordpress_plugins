<?php
class Model_diagnostic_center extends OplModel{
    
    public function __construct(){
     	
		parent::__construct();
		
    }
	
    public function saveDiagnosticCenter($table , $data){
		
		return $this->save_opl($table , $data);
	}
	
	public function getAllDiagnosticCenter($table){
		return $this->getAll_opl($table);
	}
	
	public function getFieldDiagnosticCenter($table,$fieldName){
		return $this->getField_opl($table,$fieldName);
	}
	
	public function getByIdDiagnosticCenter($table,$id){
		return $this->getById_opl($table ,$id);
	}
	
	public function deleteByIdDiagnosticCenter($table,$id){
		return $this->deleteById_opl($table , $id);
	}
	
	public function updateDiagnosticCenter($table,$data,$id){
		return $this->update_opl($table,$data,$id);
	}
}