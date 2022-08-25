<?php
class AdvertisementModel extends OplModel{
    
    public function __construct(){
     	
		parent::__construct();
		
    }
	
    public function save_advertisement($table , $data){
		
		return $this->save_opl($table , $data);
	}
	
	public function getAll_advertisement($table){
		
		return $this->getAll_opl($table);
	}

	public function getActiveAllAdvertisement($table, $field, $value ){
		
		return $this->getByWhere_opl($table, $field, $value);
	}
	
	public function getById_advertisement($table,$id){
		
		return $this->getById_opl($table ,$id);
	}

	public function getStartEndDate($table,$field,$advertisement_id){
		
		return $this->getFieldById_opl($table,$field,$advertisement_id);
	}

	public function getByAdvertisementWhere($table,$field,$value){
		
		return $this->getByWhere_opl($table,$field,$value);
	}

	public function deleteById_advertisement($table,$id){
		
		return $this->deleteById_opl($table , $id);
	}
	
	public function update_advertisement($table,$data,$id){
		
		return $this->update_opl($table,$data,$id);
	}

	public function update_counter_advertisement($table,$data,$id){
		
		return $this->update_opl($table,$data,$id);
	}

	public function getMaximumClick($table,$field,$advertisement_id){
		return $this->getFieldById_opl($table,$field,$advertisement_id);
	}

	public function getMaximumView($table,$field,$advertisement_id){
		return $this->getFieldById_opl($table,$field,$advertisement_id);
	}
	public function getScheduletype($table,$field,$advertisement_id){
		return $this->getFieldById_opl($table,$field,$advertisement_id);
	}

	public function getAdByMultipleWhere($table1, $table2, $id1, $id2, $cond_filed, $cond_value, $fields=false){
        if($fields == false){
            $fields = '*';
        }
		global $wpdb;
		$table1 = $wpdb->prefix.$table1;
		$table2 = $wpdb->prefix.$table2;

		$sql   = "SELECT $fields FROM $table1 JOIN $table2 ON $table1.$id1=$table2.$id2 WHERE $cond_filed=$cond_value";

		return $wpdb->get_results($sql);


	}
}