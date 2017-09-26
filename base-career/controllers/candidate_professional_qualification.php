<?php
	class Candidate_professional_qualification extends Basecareer_controller{
		
		function __construct()
		{
			parent::__construct();
		}

		 
		public function getAllCandidateProfessionalQualification(){
			$load              = new Basecareer_load();
			$prescriptionModel         = $load->model('model_candidate_professional_qualification');
		    $allPrescriptionOrder['allprescription'] = $prescriptionModel->getAllCandidate('candidate_professional_qualification');
            $load->view('candidate/job-list');
		   
		   //echo "test";
		}
		public function addNewCandidateProfessionalQualification($msg = null){
			$load              = new Basecareer_load();
			$load->view('candidate/candidant_apply_job', $msg);
		}
		
	
		public function saveProfessionalQualification(){
			$data             = array();
			$current_user =  wp_get_current_user();
			$data['candidate_userid']  =$current_user->ID;
			$data['title']  =$_REQUEST['title'];
			$data['institute_name']=$_REQUEST['institute_name'];
			$data['duration']=$_REQUEST['duration'];
			$data['address']=$_REQUEST['address'];

			$load = new Basecareer_load();
			$labTestModel = $load->model('model_candidate_professional_qualification');
			$success_insert = $labTestModel->save('candidate_professional_qualification' , $data);

				
			header("Location:".site_url()."/apply-job?msg=successfully create your Biodata");
		}
		
		public function getProfessionalQualificationById(){
			$load              = new Basecareer_load();
			$labTestModel         = $load->model('model_candidate_professional_qualification');
			$id                = $_GET['id'];
			$allPrescriptionOrder['allprescription'] = $labTestModel->getByIdPrescription('candidate_professional_qualification',$id);
            $load->view('prescription/edit_prescription' , $allPrescriptionOrder);
		}
		public function updateProfessionalQualification(){
			$current_user =  wp_get_current_user();
			$candidate_userid = $current_user->ID;
			$data['title']  =$_REQUEST['title'];
			$data['institute_name']=$_REQUEST['institute_name'];
			$data['duration']=$_REQUEST['duration'];
			$data['address']=$_REQUEST['address'];
			$load = new Basecareer_load();
			$professionalModel = $load->model('model_candidate_professional_qualification');
			$updateProfessional = $professionalModel->updateWhere('candidate_professional_qualification', $data , 'candidate_userid', $candidate_userid );
		
		}
		public function deleteProfessionalQualification(){
			$load             	 = new Basecareer_load();
			$labTestModel        = $load->model('model_candidate_professional_qualification');
			$id                  = $_GET['id'];
			$getPrescription = $labTestModel->getByIdPrescription('candidate_professional_qualification',$id);
			$media_id = $getPrescription[0]->prescription_media_id;
			$deleteLabTest       = $labTestModel->deleteByIdPrescription('candidate_professional_qualification',$id);
			$allPrescriptionOrder['allprescription'] = $labTestModel->getAllPrescription('candidate_professional_qualification');
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