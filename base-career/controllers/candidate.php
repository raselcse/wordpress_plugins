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
			global $wpdb;


			$tablename=$wpdb->prefix.'candidate';
			$data=array(
					'name' => $_POST['name'], 
					'date_of_birth' => $_POST['date_of_birth'],
					'gender' => $_POST['gender'], 
					'district' => $_POST['district'],
					'nationality' => $_POST['nationality'], 
					'religion' => $_POST['religion'], 
					'nationalid_or_passport' => $_POST['nationalid_or_passport'], 
					'phone_no' => $_POST['phone_no'],
					'email' => $_POST['email'],
					'marital_status' => $_POST['marital_status'], 
					'present_address' => $_POST['present_address'],
					'permanent_address' => $_POST['permanent_address'],
					'preferred_level_position' => $_POST['preferred_level_position'],
					'available_for' => $_POST['available_for'], 
					'present_salary' => $_POST['present_salary'],
					'expected_salary' => $_POST['expected_salary'], 
					'career_objective' => $_POST['career_objective'],
					'total_experience' => $_POST['total_experience'], 
					'source_of_application' => $_POST['source_of_application'],
				);
			$data_formate = array( 
							'%s', 
							'%s', 
							'%s', 
							'%s', 
							'%s', 
							'%s', 
							'%s', 
							'%s', 
							'%s', 
							'%s', 
							'%s', 
							'%s', 
							'%s', 
							'%s', 
							'%d',
							'%d',
							'%s', 
							'%s', 
							'%s', 
							);
				$wpdb->insert( $tablename, $data , $data_formate );

				
			header("Location:/solar/apply-job?msg=successfully create your Biodata");
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