<?php
	class Candidate extends Basecareer_controller{
		
		function __construct()
		{
			parent::__construct();
		}

		public	function candidate_admin_menu() {
			$candidateController = new Candidate();
			add_menu_page(
				__( 'All Candidate'),
				'All Candidate',
				'manage_options',
				'all-candidate',
				array( $candidateController ,'getAllCandidate') ,
				'',
				6
			);
		}
		public	function candidate_admin_submenu() {
			
		    $candidateController = new Candidate();
			add_submenu_page('Get data for Update data', 
							'', 
							'',
							'manage_options', 
							'getCandidateById',
							array( $candidateController ,'getCandidateById') 
							);	
			add_submenu_page('for Update data', 
							'', 
							'',
							'manage_options', 
							'updateCandidate',
							array( $candidateController ,'updateCandidate') 
							);
			add_submenu_page('Add New Candidate', 
							'', 
							'',
							'manage_options', 
							'new_candidate',
							array( $candidateController ,'addNewCandidate') 
							);
			add_submenu_page('for Delete data', 
							'', 
							'',
							'manage_options', 
							'deleteCandidate',
							array( $candidateController ,'deleteCandidate') 
							);	
			
		}
		 
		public function getAllCandidate(){
			$load              = new Basecareer_load();
			// $prescriptionModel         = $load->model('model_candidate');
			// $allPrescriptionOrder['allprescription'] = $prescriptionModel->getAllCandidate('candidate');
            $load->view('candidate/job-list');
		   
		   //echo "test";
		}
		public function addNewCandidate($msg = null){
			$load              = new Basecareer_load();
			$load->view('candidate/candidant_apply_job', $msg);
		}
		
	
		public function saveCandidate(){
			 $lab_test_name          = $_REQUEST['lab_test_name'];
			 $lab_test_description   = $_REQUEST['lab_test_description'];
			 $data             = array();
			 $data['lab_test_name']  =$lab_test_name;
			 $data['lab_test_description']=$lab_test_description;
			 
			 $load = new Basecareer_load();
			 $labTestModel = $load->model('model_prescription');
			 $success_insert = $labTestModel->saveLabTest('prescription' , $data);
		}
		
		
	
		public function getCandidateById(){
			$load              = new Basecareer_load();
			$labTestModel         = $load->model('model_prescription');
			$id                = $_GET['id'];
			$allPrescriptionOrder['allprescription'] = $labTestModel->getByIdPrescription('prescription',$id);
            $load->view('prescription/edit_prescription' , $allPrescriptionOrder);
		}
		public function updateCandidate(){
			$id                       = $_REQUEST['id'];
			$prescription_order_status = $_REQUEST['prescription_order_status'];

            
			$data             = array();
			$data['prescription_order_status']  = $prescription_order_status;
            var_dump($data['prescription_order_status']);
			$load = new Pres_load();
			$labTestModel = $load->model('model_prescription');
			$success_update = $labTestModel->updatePrescription('prescription',$data,$id);
			$msg = array();
			if($success_update){
				$msg['success_msg'] = "Data has been Updated";
			}
			else{
				$msg['error_msg'] = "Not Updated";
			}
			$allPrescriptionOrder['allprescription'] = $labTestModel->getAllPrescription('prescription');
			$load->view('prescription/edit_prescription' ,$allPrescriptionOrder, $msg);
		}
		public function deleteCandidate(){
			$load             	 = new Basecareer_load();
			$labTestModel        = $load->model('model_prescription');
			$id                  = $_GET['id'];
			$getPrescription = $labTestModel->getByIdPrescription('prescription',$id);
			$media_id = $getPrescription[0]->prescription_media_id;
			$deleteLabTest       = $labTestModel->deleteByIdPrescription('prescription',$id);
			$allPrescriptionOrder['allprescription'] = $labTestModel->getAllPrescription('prescription');
			$msg = array();
			
			if($deleteLabTest){
				$msg['success_msg'] = "Data has been Deleted";
				wp_delete_attachment( $media_id );
			}
			else{
				$msg['error_msg'] = "Not Deleted";
			}
            $load->view('prescription/all_prescription' , $allPrescriptionOrder, $msg);
		}
	
}