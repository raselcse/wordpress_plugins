<?php
class Model_dc_lab_test extends OplModel{
    
    public function __construct(){
     	
		parent::__construct();
		
    }
	
    public function saveLabDiscount($table , $data){
		
		return $this->save_opl($table , $data);
	}
	
	public function getAllLabDiscount($table, $orderField=false, $orderValue=false){
	   
		if($orderField == false){
			return $this->getAll_opl($table);
		}
		else{
			return $this->getAllWithOrder_opl($table,$orderField,$orderValue);
		}
	}
    public function getFieldName($table,$field,$id){
	
		return $this->getFieldById_opl($table,$field,$id);
		
	}
	public function getActiveAllLabDiscount($table, $field, $value ){
		
		return $this->getByWhere_opl($table, $field, $value);
	}
	
	public function getByIdLabDiscount($table,$id){
		
		return $this->getById_opl($table ,$id);
	}

	public function getByLabDiscountWhere($table, $field, $value){
		
		return $this->getByWhere_opl($table, $field, $value);
	}
	
    public function getLabDiscountOrderWhere($table, $field, $value, $orderField, $order_value){
	    
		return $this->getByFieldOrderWhere_opl($table, $field, $value, $orderField, $order_value);
		
	}
	public function deleteByIdLabDiscount($table,$id){
		
		return $this->deleteById_opl($table , $id);
	}
	
	public function updateLabDiscount($table,$data,$id){
		
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