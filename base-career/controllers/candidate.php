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
			$candidateModel         = $load->model('model_candidate');
			$allCandidates['allcandidate'] = $candidateModel->getAll('candidate');
            $load->view('candidate/candidate-list' , $allCandidates);
		   
		}
		public function addNewCandidate($msg = null){
			$load              = new Basecareer_load();
			$load->view('candidate/candidant_apply_job', $msg);
		}
		
	
		public function saveCandidate(){
				
			 $data             = array();
			 $current_user =  wp_get_current_user();
			 $data['candidate_userid']  =$current_user->ID;
			 $data['name']  =$_REQUEST['name'];
			 $data['date_of_birth']=$_REQUEST['date_of_birth'];
			 $data['gender']=$_REQUEST['gender'];
			 $data['district']=$_REQUEST['district'];
			 $data['nationality']=$_REQUEST['nationality'];
			 $data['religion']=$_REQUEST['religion'];
			 $data['nationalid_or_passport']=$_REQUEST['nationalid_or_passport'];
			 $data['phone_no']=$_REQUEST['phone_no'];
			 $data['email']=$_REQUEST['email'];
			 $data['marital_status']=$_REQUEST['marital_status'];
			 $data['present_address']=$_REQUEST['present_address'];
			 $data['permanent_address']=$_REQUEST['permanent_address'];
			 $data['preferred_level_position']=$_REQUEST['preferred_level_position'];
			 $data['available_for']=$_REQUEST['available_for'];
			 $data['present_salary']=$_REQUEST['present_salary'];
			 $data['expected_salary']=$_REQUEST['expected_salary'];
			 $data['career_objective']=$_REQUEST['career_objective'];
			 $data['total_experience']=$_REQUEST['total_experience'];
			 $data['source_of_application']=$_REQUEST['source_of_application'];
			 
			 $load = new Basecareer_load();
			 $labTestModel = $load->model('model_candidate');
			 $success_insert = $labTestModel->save('candidate' , $data);		

			header("Location:".site_url()."/apply-job?msg=successfully create your Biodata");
		}
		
	
	
		public function getCandidateById(){
			$load              = new Basecareer_load();
			$labTestModel      = $load->model('model_candidate');
			$id                = $_GET['id'];
			$allPrescriptionOrder['allprescription'] = $labTestModel->getByIdPrescription('candidate',$id);
            $load->view('prescription/edit_prescription' , $allPrescriptionOrder);
		}
		public function updateCandidate(){
			$data             = array();
			$current_user =  wp_get_current_user();
			$candidate_userid = $current_user->ID;
			$data['name']  =$_REQUEST['name'];
			$data['date_of_birth']=$_REQUEST['date_of_birth'];
			$data['gender']=$_REQUEST['gender'];
			$data['district']=$_REQUEST['district'];
			$data['nationality']=$_REQUEST['nationality'];
			$data['religion']=$_REQUEST['religion'];
			$data['nationalid_or_passport']=$_REQUEST['nationalid_or_passport'];
			$data['phone_no']=$_REQUEST['phone_no'];
			$data['email']=$_REQUEST['email'];
			$data['marital_status']=$_REQUEST['marital_status'];
			$data['present_address']=$_REQUEST['present_address'];
			$data['permanent_address']=$_REQUEST['permanent_address'];
			$data['preferred_level_position']=$_REQUEST['preferred_level_position'];
			$data['available_for']=$_REQUEST['available_for'];
			$data['present_salary']=$_REQUEST['present_salary'];
			$data['expected_salary']=$_REQUEST['expected_salary'];
			$data['career_objective']=$_REQUEST['career_objective'];
			$data['total_experience']=$_REQUEST['total_experience'];
			$data['source_of_application']=$_REQUEST['source_of_application'];
			$load = new Basecareer_load();
			$candidateeModel = $load->model('model_candidate');
			//var_dump($data);
			$updateCandidate = $candidateeModel->updateWhere('candidate', $data , 'candidate_userid', $candidate_userid );
			header("Location:".site_url()."/edit-my-cv?msg=successfully create Update your CV");
		}
		public function deleteCandidate(){
			$load             	 = new Basecareer_load();
			$labTestModel        = $load->model('model_candidate');
			$id                  = $_GET['id'];
			$getPrescription = $labTestModel->getByIdPrescription('candidate',$id);
			$media_id = $getPrescription[0]->prescription_media_id;
			$deleteLabTest       = $labTestModel->deleteByIdPrescription('candidate',$id);
			$allPrescriptionOrder['allprescription'] = $labTestModel->getAllPrescription(candidate);
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