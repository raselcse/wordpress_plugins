<?php
class Model_prescription extends Pres_model{
    
    public function __construct(){
     	
		parent::__construct();
		
    }
	
    public function savePrescription($table , $data){
		
		return $this->save_opl($table , $data);
	}
	
	public function getAllPrescription($table){
		
		return $this->getAll_opl($table);
	}

	public function getActiveAllPrescription($table, $field, $value ){
		
		return $this->getByWhere_opl($table, $field, $value);
	}
	
	public function getByIdPrescription($table,$id){
		
		return $this->getById_opl($table ,$id);
	}

	public function getByPrescriptionWhere($table,$field,$value){
		
		return $this->getByWhere_opl($table,$field,$value);
	}

	public function deleteByIdPrescription($table,$id){
		
		return $this->deleteById_opl($table , $id);
		
	}
	
	public function updatePrescription($table,$data,$id){
		
		return $this->update_opl($table,$data,$id);
	}

	public function updateWhere($table, $data, $field, $id){
		
		return $this->updateWhere_opl($table,$data,$field,$id);
	}
}