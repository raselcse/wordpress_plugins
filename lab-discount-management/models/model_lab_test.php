<?php
class Model_lab_test extends OplModel{
    
    public function __construct(){
     	
		parent::__construct();
		
    }
	
    public function saveLabTest($table , $data){
		
		return $this->save_opl($table , $data);
	}
	
	public function getAllLabTest($table){
		
		return $this->getAll_opl($table);
	}

	public function getActiveAllLabTest($table, $field, $value ){
		
		return $this->getByWhere_opl($table, $field, $value);
	}
	
	public function getByIdLabTest($table,$id){
		
		return $this->getById_opl($table ,$id);
	}

	public function getByLabTestWhere($table,$field,$value){
		
		return $this->getByWhere_opl($table,$field,$value);
	}

	public function deleteByIdLabTest($table,$id){
		
		return $this->deleteById_opl($table , $id);
	}
	
	public function updateLabTest($table,$data,$id){
		
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