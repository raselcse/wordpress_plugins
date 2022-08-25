<?php
	class Dc_lab_test extends OplController{
		
		function __construct()
		{
			parent::__construct();
		}

		
		public	function opl_admin_submenu() {
			
			
			add_submenu_page('lab_test', 
							'All Discount ', 
							'All Discount',
							'manage_options', 
							'allLabDiscount',
							array( 'Dc_lab_test','allLabDiscount') 
							);
			
			add_submenu_page('lab_test', 
							'Add New Discount ', 
							'Add New Discount',
							'manage_options', 
							'add_lab_discount',
							array( 'Dc_lab_test','add_lab_discount') 
							);
			add_submenu_page('For Saving data', 
							'', 
							'',
							'manage_options', 
							'saveLabDiscount',
							array( 'Dc_lab_test','saveLabDiscount') 
							);	
			add_submenu_page('Get data for Update data', 
							'', 
							'',
							'manage_options', 
							'getLabDiscountById',
							array( 'Dc_lab_test','getLabDiscountById') 
							);	
			add_submenu_page('for Update data', 
							'', 
							'',
							'manage_options', 
							'updateLabDiscount',
							array( 'Dc_lab_test','updateLabDiscount') 
							);
			add_submenu_page('for Delete data', 
							'', 
							'',
							'manage_options', 
							'deleteLabDiscount',
							array( 'Dc_lab_test','deleteLabDiscount') 
							);	
			
		}
		
		public function add_lab_discount(){
			$load                  = new Load();
            $labTestModel          = $load->model('model_lab_test');
            $dcModel               = $load->model('model_diagnostic_center');
			
			$allLabTestt['alltest'] = $labTestModel->getAllLabTest('lab_test');
			
			$alldiagnosticCenter['diagnostic_centeres'] = $dcModel->getAllDiagnosticCenter('diagnostic_center');
			$load->view('dc_lab_test/add_new_dc_lab_test' ,$allLabTestt,$alldiagnosticCenter);
			
		}
		
		public function saveLabDiscount(){
			 $discount_name        = $_REQUEST['discount_name'];
			 $test_price           = $_REQUEST['test_price'];
			 $lab_test_id          = $_REQUEST['lab_test_id'];
			 $dc_id                = $_REQUEST['dc_id'];
			 $discount_amount      = $_REQUEST['discount_amount'];
			 $discount_description = $_REQUEST['discount_description'];
			 
			  
			 $data                   = array();
			 $data['discount_name']          =$discount_name;
			 $data['lab_test_id']            =$lab_test_id;
			 $data['dc_id']                  =$dc_id;
			 $data['test_price']			 =$test_price;
			 $data['discount_amount']	 	 =$discount_amount;
			 $data['discount_description']   =$discount_description;
			 $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				$random_code = "";
				for ($i = 0; $i < 10; $i++) {
					$random_code .= $chars[mt_rand(0, strlen($chars)-1)];
				}
			 $data['discount_coupon'] = $random_code;
			 
			 $load = new Load();
			 $labTestModel = $load->model('model_dc_lab_test');
			 $success_insert = $labTestModel->saveLabDiscount('dc_lab_test' , $data);
			$msg = array();
			if($success_insert){
				$msg['success_msg'] = "Data has been added";
			}
			else{
				$msg['error_msg'] = "Cannot added data to server";
			}
			$load->view('dc_lab_test/add_new_dc_lab_test' , $msg);
		}
		
		public function allLabDiscount(){
			$load              = new Load();
			$labDiscountModel         = $load->model('model_dc_lab_test');
			$allDiscountTest['alldiscount'] = $labDiscountModel->getAllLabDiscount('dc_lab_test');
           
			$load->view('dc_lab_test/all_dc_lab_test' , $allDiscountTest);
		}
	 
	    public function discount_list_one_search_lab_test(){
		    $lab_test_id = $_REQUEST['lab_test_id'];
			if($lab_test_id){
				$load              = new Load();
				$labDiscountModel         = $load->model('model_dc_lab_test');
				$sort = $_REQUEST['sort'];
				if($sort=='high'){
					$allDiscountTest['alldiscount'] = $labDiscountModel->getLabDiscountOrderWhere('dc_lab_test', 'lab_test_id' , $lab_test_id , 'discount_amount','DESC');
				}
				elseif($sort=='low'){
					$allDiscountTest['alldiscount'] = $labDiscountModel->getLabDiscountOrderWhere('dc_lab_test', 'lab_test_id' , $lab_test_id , 'discount_amount','ASC');
				}
				else{
					$allDiscountTest['alldiscount'] = $labDiscountModel->getByLabDiscountWhere('dc_lab_test', 'lab_test_id' , $lab_test_id);	
				}
				$load->view('dc_lab_test/all_dc_on_search_lab_test' , $allDiscountTest);
			}
			else{
			    $load              = new Load();
				$labDiscountModel         = $load->model('model_dc_lab_test');
				$sort = $_REQUEST['sort'];
				if($sort=='high'){
				$allDiscountTest['alldiscount'] = $labDiscountModel->getAllLabDiscount('dc_lab_test','discount_amount','DESC');
				}
			   elseif($sort=='low'){
			     $allDiscountTest['alldiscount'] = $labDiscountModel->getAllLabDiscount('dc_lab_test' ,'discount_amount','ASC');
			   }
			   else{
				  $allDiscountTest['alldiscount'] = $labDiscountModel->getAllLabDiscount('dc_lab_test'); 
				 }
				$load->view('dc_lab_test/all_dc_on_search_lab_test' , $allDiscountTest);
			}
		}
		
		public function getLabDiscountById(){
			$load              = new Load();
			$labDiscountModel         = $load->model('model_dc_lab_test');
			$id                = $_GET['id'];
			$allLabDiscount['alldiscount'] = $labDiscountModel->getByIdLabDiscount('dc_lab_test',$id);
			
			$labTestModel          = $load->model('model_lab_test');
            $dcModel               = $load->model('model_diagnostic_center');
			
			$allLabDiscountList['alltest'] = $labTestModel->getAllLabTest('lab_test');
			
			$alldiagnosticCenter['diagnostic_centeres'] = $dcModel->getAllDiagnosticCenter('diagnostic_center');
            
			$load->view('dc_lab_test/edit_dc_lab_test' , $allLabDiscount , $allLabDiscountList , $alldiagnosticCenter);
		}
		public function updateLabDiscount(){
			$id                     = $_REQUEST['id'];
			$discount_name        = $_REQUEST['discount_name'];
			$test_price           = $_REQUEST['test_price'];
			$lab_test_id          = $_REQUEST['lab_test_id'];
			$dc_id                = $_REQUEST['dc_id'];
			$discount_amount      = $_REQUEST['discount_amount'];
			$discount_description = $_REQUEST['discount_description'];


			$data                         = array();
			$data['discount_name']        =$discount_name;
			$data['lab_test_id']          =$lab_test_id;
			$data['dc_id']                =$dc_id;
			$data['test_price']			  =$test_price;
			$data['discount_amount']	  =$discount_amount;
			$data['discount_description'] =$discount_description;


			$load = new Load();
			$labTestModel = $load->model('model_dc_lab_test');
			$success_update = $labTestModel->updateLabDiscount('dc_lab_test',$data,$id);
			$msg = array();
			if($success_update){
				$msg['success_msg'] = "Data has been Updated";

			}
			else{
				$msg['error_msg'] = "Not Updated";
			}
			$allLabDiscount['alldiscount'] = $labTestModel->getallLabDiscount('dc_lab_test');
			$load->view('dc_lab_test/all_dc_lab_test' ,$allLabDiscount, $msg);
		}
		public function deleteLabDiscount(){
			$load              = new Load();
			$labTestModel         = $load->model('model_dc_lab_test');
			$id                = $_GET['id'];
			$deleteLabTest       = $labTestModel->deleteByIdLabDiscount('dc_lab_test',$id);
			$allLabDiscount['alldiscount'] = $labTestModel->getallLabDiscount('dc_lab_test');
			$msg = array();
			if($deleteLabTest){
				$msg['success_msg'] = "Data has been Deleted";
			}
			else{
				$msg['error_msg'] = "Not Deleted";
			}
            $load->view('dc_lab_test/all_dc_lab_test' , $allLabDiscount, $msg);
		}
	
}