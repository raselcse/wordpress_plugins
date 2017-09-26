<?php
	class Apply_job extends Basecareer_controller{
		
		function __construct()
		{
			parent::__construct();
		}

		
		 
		public function getAllCv(){
			$load              = new Basecareer_load();
			// $prescriptionModel         = $load->model('model_candidate');
			// $allPrescriptionOrder['allprescription'] = $prescriptionModel->getAllCandidate('candidate');
            $load->view('candidate/job-list');
		   
		   //echo "test";
		}
		public function applyNew($msg = null){
		   
		    $isApplyThisJob = $this->isApplyThisJob();
			$data = array();
			$data['isApplyThisJob']= $isApplyThisJob;
			$data['job_id']= 10;
			$load              = new Basecareer_load();
            $load->template('apply_job', $data);
			// var_dump($data);
		}
		
	
		public function applyJobAction(){
			 $data = array();
			 $current_user =  wp_get_current_user();
			 if($current_user->ID != NULL){
				$data['candidate_userid']  = $current_user->ID;
				$data['job_id']  = $_REQUEST['job_id'];
				$data['expected_salary'] = $_REQUEST['expected_salary'];
				$data['apply_date'] = date("Y-m-d");
				$job_id = $data['job_id'];
				$candidate_userid = $data['candidate_userid'];
				$load = new Basecareer_load();
				$applyJobModel = $load->model('model_apply_job');
				$candidateFileModel = $load->model('model_candidate_file');
				
				$checkApply = $applyJobModel->rawCountJobApply('apply_job' , 'job_id', $job_id , 'candidate_userid',$candidate_userid );
				
				$isCvUpload = $candidateFileModel->fieldValueExist('candidate_file', 'resume' ,'candidate_userid',$candidate_userid );
				
				
				if($isCvUpload != ""){
					if($checkApply > 0){
						$current_url = get_permalink( $job_id );
						wp_redirect( ''.$current_url.'?msg=notsuccess ' );
							exit;
					}
					else{
						$success_insert = $applyJobModel->save('apply_job' , $data);	
						$current_url = get_permalink( $data['job_id'] );
						wp_redirect( ''.$current_url.'?msg=success ' );
							exit;
					}
				}
				else{
				    $current_url = get_permalink( $job_id );
					wp_redirect( ''.$current_url.'?msg=cvnotuploaded ' );
				}
			}
			else{
				header("Location:".site_url()."/login");
			}
		}
		
		
	
		public function getCvByUserId(){
			$load              = new Basecareer_load();
			$candidateModel      = $load->model('model_candidate');
			$current_user = wp_get_current_user();
			$userid = $current_user->ID;
			$candidate['basicinfo'] = $candidateModel->getByWhere('candidate' , 'candidate_userid', $userid);
			$candidate['experiences'] = $candidateModel->getByWhere('candidate_experience' , 'candidate_userid', $userid);
			$candidate['academic_qualifications'] = $candidateModel->getByWhere('candidate_academic_qualification' , 'candidate_userid', $userid);
			$candidate['professional_qualifications'] = $candidateModel->getByWhere('candidate_professional_qualification' , 'candidate_userid', $userid);
			$candidate['references'] = $candidateModel->getByWhere('candidate_reference' , 'candidate_userid', $userid);
            $load->template('candidate_profile_edit' , $candidate);
		}
		
		public function deleteCv(){
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
		
		public function isApplyThisJob($jobId){
			$current_user = wp_get_current_user();
			$userid = $current_user->ID;
			global $wpdb;
			$table = $wpdb->prefix.apply_job;
			$sql   = "SELECT count(id) as applyExistThisJob FROM $table WHERE job_id=$jobId";
			
			return $wpdb->get_results($sql);
			
		}
	
}