<?php
class Load{
		
	   function __construct(){}
		
		public function view($filename , $data = false , $msg= false){
		    if($data == true){
			    extract($data);
			}
			 if($msg == true){
			    extract($msg);
			}
			include_once plugin_dir_path( __FILE__ ) ."../../views/".$filename.".php";
		}
		public function model($modelName){
		    include_once plugin_dir_path( __FILE__ ) ."../../models/".$modelName.".php"; 
			return new $modelName();
		
		}
	}