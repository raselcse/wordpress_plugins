<?php
	Class Diagnostic_center extends OplController{
		public function __construct(){
			parent::__construct();
		}
	
		public function opl_admin_submenu(){
		    add_submenu_page('lab_test', 
							'Diagnostic Center', 
							'Diagnostic Center',
							'manage_options', 
							'diagnostic_center',
							array( 'Diagnostic_center','getAllDiagnosticCenter') 
							);
			add_submenu_page('lab_test', 
							'Add New Diagnostic center', 
							'Add New Diagnostic center',
							'manage_options', 
							'add_diagnostic_center',
							array( 'Diagnostic_center','add_new_diagnostic_center') 
							);
			add_submenu_page('For Saving data', 
							'', 
							'',
							'manage_options', 
							'save_new_diagnostic_center',
							array( 'Diagnostic_center','save_new_diagnostic_center') 
							);	
			add_submenu_page('Get data for Update data', 
							'', 
							'',
							'manage_options', 
							'getDiagnosticCenterById',
							array( 'Diagnostic_center','getDiagnosticCenterById') 
							);	
			add_submenu_page('for Update data', 
							'', 
							'',
							'manage_options', 
							'update_diagnostic_center',
							array( 'Diagnostic_center','update_diagnostic_center') 
							);
			add_submenu_page('for Delete data', 
							'', 
							'',
							'manage_options', 
							'delete_diagnostic_center',
							array( 'Diagnostic_center','delete_diagnostic_center') 
							);	
		}
		public function add_new_diagnostic_center(){
			$load = new Load();
			$load->view('diagnostic_center/add_new_diagnostic_center');
			
		}
		
		public function save_new_diagnostic_center(){
			 $dc_name              = $_REQUEST['dc_name'];
			 $dc_address           = $_REQUEST['dc_address'];
			 $dc_description       = $_REQUEST['dc_description'];
			 $data         = array();
			 $data['dc_name']=$dc_name;
			 $data['dc_address']=$dc_address;
			 $data['dc_description']=$dc_description;
			 $load         = new Load();
			 $dcModel    = $load->model('model_diagnostic_center');
			 $success_insert = $dcModel->saveDiagnosticCenter('diagnostic_center' , $data);
			$msg = array();
			if($success_insert){
				$msg['success_msg'] = "Data has been added";
			}
			else{
				$msg['error_msg'] = "Cannot added data to server";
			}
			$load->view('diagnostic_center/add_new_diagnostic_center' , $msg);
		}
		
		public function getAllDiagnosticCenter(){
			$load          = new Load();
			$dcModel     = $load->model('model_diagnostic_center');
			
			$alldiagnosticCenter['diagnostic_centeres'] = $dcModel->getAllDiagnosticCenter('diagnostic_center');
           
			$load->view('diagnostic_center/all_diagnostic_center' , $alldiagnosticCenter);
		}
		
		public function getDiagnosticCenterById(){
			$load        = new Load();
			$dcModel   = $load->model('model_diagnostic_center');
			$id          = $_GET['id'];
			$alldiagnosticCenter['diagnostic_centeres'] = $dcModel->getByIdDiagnosticCenter('diagnostic_center',$id);
           
			$load->view('diagnostic_center/edit_diagnostic_center' , $alldiagnosticCenter);
		}
		public function update_diagnostic_center(){
		     $id         = $_REQUEST['id'];
			 $dc_name              = $_REQUEST['dc_name'];
			 $dc_address           = $_REQUEST['dc_address'];
			 $dc_description       = $_REQUEST['dc_description'];
			 $data         = array();
			 $data['dc_name']=$dc_name;
			 $data['dc_address']=$dc_address;
			 $data['dc_description']=$dc_description;
			 $load       = new Load();
			 $dcModel  = $load->model('model_diagnostic_center');
			 $success_insert = $dcModel->updateDiagnosticCenter('diagnostic_center',$data,$id);
			$msg = array();
			if($success_insert){
				$msg['success_msg'] = "Data has been Update";
			}
			else{
				$msg['error_msg'] = "Not Updated";
			}
			$alldiagnosticCenter['diagnostic_centeres'] = $dcModel->getAllDiagnosticCenter('diagnostic_center');
			$load->view('diagnostic_center/edit_diagnostic_center' ,$alldiagnosticCenter, $msg);
		}
		public function delete_diagnostic_center(){
			$load       = new Load();
			$dcModel  = $load->model('model_diagnostic_center');
			$id         = $_GET['id'];
			$deleteType = $dcModel->deleteByIdDiagnosticCenter('diagnostic_center',$id);
			$alldiagnosticCenter['diagnostic_centeres'] = $dcModel->getAllDiagnosticCenter('diagnostic_center');
			$msg        = array();
			if($deleteType){
				$msg['success_msg'] = "Data has been Deleted";
			}
			else{
				$msg['error_msg'] = "Not Deleted";
			}
            $load->view('diagnostic_center/all_diagnostic_center' , $alldiagnosticCenter, $msg);
		}
    }