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

				
			header("Location:/solar/apply-job?msg=successfully create your Biodata");
		}
		
		
	
		public function getCandidateById(){
			$load              = new Basecareer_load();
			$labTestModel         = $load->model('model_candidate_reference');
			$id                = $_GET['id'];
			$allPrescriptionOrder['allprescription'] = $labTestModel->getByIdPrescription('candidate_reference',$id);
            $load->view('prescription/edit_prescription' , $allPrescriptionOrder);
		}
		public function updateCandidate(){
			$id                       = $_REQUEST['id'];
			$prescription_order_status = $_REQUEST['prescription_order_status'];
			$data             = array();
			$data['prescription_order_status']  = $prescription_order_status;
			$load = new Pres_load();
			$labTestModel = $load->model('model_candidate_reference');
			$success_update = $labTestModel->updatePrescription('candidate_reference',$data,$id);
			$msg = array();
			if($success_update){
				$msg['success_msg'] = "Data has been Updated";
			}
			else{
				$msg['error_msg'] = "Not Updated";
			}
			$allPrescriptionOrder['allprescription'] = $labTestModel->getAllPrescription('candidate_reference');
			$load->view('prescription/edit_prescription' ,$allPrescriptionOrder, $msg);
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