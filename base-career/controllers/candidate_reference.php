<?php
	class Candidate_reference extends Basecareer_controller{
		
		function __construct()
		{
			parent::__construct();
		}

		 
		public function getAllCandidateReference(){
			$load              = new Basecareer_load();
			$prescriptionModel         = $load->model('model_candidate_reference');
		    $allPrescriptionOrder['allprescription'] = $prescriptionModel->getAllCandidate('candidate_experience');
            $load->view('candidate/job-list');
		   
		   //echo "test";
		}
		public function addNewReference($msg = null){
			$load              = new Basecareer_load();
			$load->view('candidate/candidant_apply_job', $msg);
		}
		
	
		public function saveReference(){
			 $data             = array();
			 $current_user =  wp_get_current_user();
			 $data['candidate_userid']  = $current_user->ID;
			 $data['full_name']  =$_REQUEST['full_name'];
			 $data['designation_company_address']=$_REQUEST['designation_company_address'];
			 $data['relationship']=$_REQUEST['relationship'];
			 $data['mobile']=$_REQUEST['mobile'];
			 $data['email']=$_REQUEST['email'];
			 $load = new Basecareer_load();
			 $labTestModel = $load->model('model_candidate_reference');
			 $success_insert = $labTestModel->save('candidate_reference' , $data);

				
			header("Location:".site_url()."/apply-job?msg=successfully create your Biodata");
		}
		
		
	
		public function getCandidateById(){
			$load              = new Basecareer_load();
			$labTestModel         = $load->model('model_candidate_reference');
			$id                = $_GET['id'];
			$allPrescriptionOrder['allprescription'] = $labTestModel->getByIdPrescription('candidate_reference',$id);
            $load->view('prescription/edit_prescription' , $allPrescriptionOrder);
		}
		public function updateReference(){
			$data             = array();
			$current_user =  wp_get_current_user();
			$candidate_userid = $current_user->ID;
			$data['full_name']  =$_REQUEST['full_name'];
			$data['designation_company_address']=$_REQUEST['designation_company_address'];
			$data['relationship']=$_REQUEST['relationship'];
			$data['mobile']=$_REQUEST['mobile'];
			$data['email']=$_REQUEST['email-reference'];
			$load = new Basecareer_load();
			$referenceModel = $load->model('model_candidate_reference');
			$referenceModel->updateWhere('candidate_reference', $data , 'candidate_userid', $candidate_userid );
			header("Location:".site_url()."/edit-my-cv?msg=successfully create Update your CV");
		}
		public function deleteCandidateReference(){
			$load             	 = new Basecareer_load();
			$labTestModel        = $load->model('model_candidate_reference');
			$id                  = $_GET['id'];
			$getPrescription = $labTestModel->getByIdPrescription('candidate_reference',$id);
			$media_id = $getPrescription[0]->prescription_media_id;
			$deleteLabTest       = $labTestModel->deleteByIdPrescription('candidate_reference',$id);
			$allPrescriptionOrder['allprescription'] = $labTestModel->getAllPrescription('candidate_reference');
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