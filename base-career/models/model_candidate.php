<?php
class Model_candidate extends Basecareer_model{
    
    public function __construct(){
     	
		parent::__construct();
		
    }
	
    public function saveCandidate($table , $data){
		
		return $this->save_opl($table , $data);
	}
	
	public function getAllCandidate($table){
		
		return $this->getAll_opl($table);
	}

	public function getActiveAllCandidate($table, $field, $value ){
		
		return $this->getByWhere_opl($table, $field, $value);
	}
	
	public function getByIdCandidate($table,$id){
		
		return $this->getById_opl($table ,$id);
	}

	public function getByCandidateWhere($table,$field,$value){
		
		return $this->getByWhere_opl($table,$field,$value);
	}

	public function deleteByIdCandidate($table,$id){
		
		return $this->deleteById_opl($table , $id);
		
	}
	
	public function updateCandidate($table,$data,$id){
		
		return $this->update_opl($table,$data,$id);
	}
}