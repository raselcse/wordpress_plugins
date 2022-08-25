<?php
	class OplDatabase{
		protected $tables;
		public function __construct(){
			global $wpdb;
			
			$this->tables = array('advertise_types'=> $wpdb->prefix.'advertise_types',
								  'advertises' 	   => $wpdb->prefix.'advertises'
								);
		}
		public function insert($table_advertise_types, $data ){
			
		}
		
	}