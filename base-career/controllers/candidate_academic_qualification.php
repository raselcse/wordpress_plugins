<?php
	class Candidate_academic_qualification extends Basecareer_controller{
		
		function __construct()
		{
			parent::__construct();
		}

		

		 
		public function getAllCandidateQualification(){
			$load              = new Basecareer_load();
			$prescriptionModel         = $load->model('model_candidate_academic_qualification');
		    $allPrescriptionOrder['allprescription'] = $prescriptionModel->getAllCandidate('candidate_academic_qualification');
            $load->view('candidate/job-list');
		   
		   //echo "test";
		}
		public function addNewCandidateQualification($msg = null){
			$load              = new Basecareer_load();
			$load->view('candidate/candidant_apply_job', $msg);
		}
		
	
		public function saveAcademicQualification(){
			 $data             = array();
			 $current_user =  wp_get_current_user();
			 $data['candidate_userid']  =$current_user->ID;
			 $data['examination']  =$_REQUEST['examination'];
			 $data['school']=$_REQUEST['school'];
			 $data['board']=$_REQUEST['board'];
			 $data['subject']=$_REQUEST['subject'];
			 $data['result']=$_REQUEST['result'];
			 $data['subject_group']=$_REQUEST['subject_group'];
			 $data['passing_year']=$_REQUEST['passing_year'];
			 
			 $load = new Basecareer_load();
			 $labTestModel = $load->model('model_candidate_academic_qualification');
			 $success_insert = $labTestModel->save('candidate_academic_qualification' , $data);

				
			header("Location:".site_url()."/apply-job?msg=successfully create your Biodata");
		}
		
		
	
		public function getCandidateQualificationById(){
			$load              = new Basecareer_load();
			$labTestModel         = $load->model('model_candidate_academic_qualification');
			$id                = $_GET['id'];
			$allPrescriptionOrder['allprescription'] = $labTestModel->getByIdPrescription('candidate_experience',$id);
            $load->view('prescription/edit_prescription' , $allPrescriptionOrder);
		}
		public function updateAcademicQualification(){
			$current_user =  wp_get_current_user();
			$candidate_userid = $current_user->ID;
			$data['examination']  =$_REQUEST['examination'];
			$data['school']=$_REQUEST['school'];
			$data['board']=$_REQUEST['board'];
			$data['subject']=$_REQUEST['subject'];
			$data['result']=$_REQUEST['result'];
			$data['subject_group']=$_REQUEST['subject_group'];
			$data['passing_year']=$_REQUEST['passing_year'];
			$load = new Basecareer_load();
			$academicModel = $load->model('model_candidate_academic_qualification');
			$updateAcademic = $academicModel->updateWhere('candidate_academic_qualification', $data , 'candidate_userid', $candidate_userid );
		}
		public function deleteCandidateQualification(){
			$load             	 = new Basecareer_load();
			$labTestModel        = $load->model('model_candidate_academic_qualification');
			$id                  = $_GET['id'];
			$getPrescription = $labTestModel->getByIdPrescription('candidate_experience',$id);
			$media_id = $getPrescription[0]->prescription_media_id;
			$deleteLabTest       = $labTestModel->deleteByIdPrescription('candidate_experience',$id);
			$allPrescriptionOrder['allprescription'] = $labTestModel->getAllPrescription('candidate_experience');
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