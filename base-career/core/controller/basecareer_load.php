<?php
class Basecareer_load{
		
	   function __construct(){}
		
		public function template($filename , $data = false , $msg= false, $moredata = false){
		    if($data == true){
			    extract($data);
			}
			 if($msg == true){
			    extract($msg);
			}
			if($moredata == true){
			    extract($moredata);
			}
			include_once plugin_dir_path( __FILE__ ) ."../../template/".$filename.".php";
		}
		

		
		public function model($modelName){
		    include_once plugin_dir_path( __FILE__ ) ."../../models/".$modelName.".php"; 
			return new $modelName();
		
		}
	}