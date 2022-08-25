<?php
	class Lab_test extends OplController{
		
		function __construct()
		{
			parent::__construct();
		}

		public	function opl_admin_menu() {
			add_menu_page(
				__( 'Lab Test'),
				'Lab Test',
				'manage_options',
				'lab_test',
				array( 'Lab_test','getAllLabTest') ,
				'',
				plugins_url( 'myplugin/images/icon.png' ),
				6
			);
		}
		public	function opl_admin_submenu() {
			
			
			add_submenu_page('lab_test', 
							'Add New Lab Test ', 
							'Add New Lab Test',
							'manage_options', 
							'add_LabTest',
							array( 'Lab_test','add_new_LabTest') 
							);
			add_submenu_page('For Saving data', 
							'', 
							'',
							'manage_options', 
							'saveLabTest',
							array( 'Lab_test','saveLabTest') 
							);	
			add_submenu_page('Get data for Update data', 
							'', 
							'',
							'manage_options', 
							'getLabTestById',
							array( 'Lab_test','getLabTestById') 
							);	
			add_submenu_page('for Update data', 
							'', 
							'',
							'manage_options', 
							'updateLabTest',
							array( 'Lab_test','updateLabTest') 
							);
			add_submenu_page('for Delete data', 
							'', 
							'',
							'manage_options', 
							'deleteLabTest',
							array( 'Lab_test','deleteLabTest') 
							);	
			
		}
		public function lab_test_list_shortcode(){
			$load              = new Load();
			$labTestModel         = $load->model('model_lab_test');
			$allLabTest['alltest'] = $labTestModel->getAllLabTest('lab_test');
			$load->view('lab_test/front_end_all_lab_test' , $allLabTest);
		}
		
		
		public function add_new_LabTest(){
			$load              = new Load();

			$load->view('lab_test/add_new_lab_test');
			//$table_advertise_types = $this->tables['advertise_types'];
			
		}
		
		public function saveLabTest(){
			 $lab_test_name          = $_REQUEST['lab_test_name'];
			 $lab_test_description   = $_REQUEST['lab_test_description'];
			 
			  
			 $data             = array();
			 $data['lab_test_name']  =$lab_test_name;
			 $data['lab_test_description']=$lab_test_description;
			 
			 $load = new Load();
			 $labTestModel = $load->model('model_lab_test');
			 $success_insert = $labTestModel->saveLabTest('lab_test' , $data);
			$msg = array();
			if($success_insert){
				$msg['success_msg'] = "Data has been added";
			}
			else{
				$msg['error_msg'] = "Cannot added data to server";
			}
			$load->view('lab_test/add_new_lab_test' , $msg);
		}
		
		public function getAllLabTest(){
			$load              = new Load();
			$labTestModel         = $load->model('model_lab_test');
			$allLabTest['alltest'] = $labTestModel->getAllLabTest('lab_test');
           
			$load->view('lab_test/all_lab_test' , $allLabTest);
		}
	
		public function getLabTestById(){
			$load              = new Load();
			$labTestModel         = $load->model('model_lab_test');
			$id                = $_GET['id'];
			$allLabTest['alltest'] = $labTestModel->getByIdLabTest('lab_test',$id);
            
			$load->view('lab_test/edit_lab_test' , $allLabTest);
		}
		public function updateLabTest(){
		     $id                     = $_REQUEST['id'];
			 $lab_test_name          = $_REQUEST['lab_test_name'];
			 $lab_test_description   = $_REQUEST['lab_test_description'];
			 

			 $data             = array();
			 $data['lab_test_name']  =$lab_test_name;
			 $data['lab_test_description']=$lab_test_description;
			 

			 $load = new Load();
			 $labTestModel = $load->model('model_lab_test');
			 $success_update = $labTestModel->updateLabTest('lab_test',$data,$id);
			$msg = array();
			if($success_update){
				$msg['success_msg'] = "Data has been Updated";

			}
			else{
				$msg['error_msg'] = "Not Updated";
			}
			$allLabTest['alltest'] = $labTestModel->getAllLabTest('lab_test');
			$load->view('lab_test/edit_lab_test' ,$allLabTest, $msg);
		}
		public function deleteLabTest(){
			$load              = new Load();
			$labTestModel         = $load->model('model_lab_test');
			$id                = $_GET['id'];
			$deleteLabTest       = $labTestModel->deleteByIdLabTest('lab_test',$id);
			$allLabTest['alltest'] = $labTestModel->getAllLabTest('lab_test');
			$msg = array();
			if($deleteLabTest){
				$msg['success_msg'] = "Data has been Deleted";
			}
			else{
				$msg['error_msg'] = "Not Deleted";
			}
            $load->view('lab_test/all_lab_test' , $allLabTest, $msg);
		}
	
}