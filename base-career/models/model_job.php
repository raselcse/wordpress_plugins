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

	
	// public function getAdByMultipleWhere($table1, $table2, $id1, $id2, $cond_filed, $cond_value, $fields=false){
        // if($fields == false){
            // $fields = '*';
        // }
		// global $wpdb;
		// $table1 = $wpdb->prefix.$table1;
		// $table2 = $wpdb->prefix.$table2;

		// $sql   = "SELECT $fields FROM $table1 JOIN $table2 ON $table1.$id1=$table2.$id2 WHERE $cond_filed=$cond_value";

		// return $wpdb->get_results($sql);


	// }
}