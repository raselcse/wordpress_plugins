<?php
	class Job extends Basecareer_controller{
		
		function __construct()
		{
			parent::__construct();
		}

		public	function prescription_admin_menu() {
			add_menu_page(
				__( 'Prescription Order'),
				'Prescription Order',
				'manage_options',
				'prescription_order',
				array( 'Prescription','getAllPrescriptionOrder') ,
				'',
				6
			);
		}
		public	function prescription_admin_submenu() {
			
			
		
			add_submenu_page('prescription_order', 
							'setting page', 
							'setting page',
							'manage_options', 
							'prescription_setting',
							array( 'prescription','prescription_settings_page') 
							);	
			add_submenu_page('Get data for Update data', 
							'', 
							'',
							'manage_options', 
							'getPrescriptionById',
							array( 'prescription','getPrescriptionById') 
							);	
			add_submenu_page('for Update data', 
							'', 
							'',
							'manage_options', 
							'updatePrescription',
							array( 'prescription','updatePrescription') 
							);
			add_submenu_page('for Delete data', 
							'', 
							'',
							'manage_options', 
							'deletePrescription',
							array( 'prescription','deletePrescription') 
							);	
			
		}
		 
		
		public function add_new_prescription($msg = null){
			$load              = new Pres_load();
            global $current_user;
			$user_data = array();
			$user_data['user_id'] =  $current_user->ID;
			$user_data['user_name'] =  $current_user->user_login;
			$user_data['user_email'] =  $current_user->user_email;
			$user_data['user_phone'] =  $current_user->user_phone;
			
			$load->view('prescription/add_new_prescription', $msg);
			//var_dump($user_data);
		}
		
		public function get_current_user_data(){
			global $current_user;
			$user_data = array();
			$user_data['user_id'] =  $current_user->ID;
			$user_data['user_name'] =  $current_user->user_login;
			$user_data['user_email'] =  $current_user->user_email;
			$user_data['user_phone'] =  $current_user->user_phone;
			var_dump($user_data);
		}
		public function savePrescription(){
			 $lab_test_name          = $_REQUEST['lab_test_name'];
			 $lab_test_description   = $_REQUEST['lab_test_description'];
			 $data             = array();
			 $data['lab_test_name']  =$lab_test_name;
			 $data['lab_test_description']=$lab_test_description;
			 
			 $load = new Pres_load();
			 $labTestModel = $load->model('model_prescription');
			 $success_insert = $labTestModel->saveLabTest('prescription' , $data);
			
			
		}
		
		public function getAllPrescriptionOrder(){
			$load              = new Pres_load();
			$prescriptionModel         = $load->model('model_prescription');
			$allPrescriptionOrder['allprescription'] = $prescriptionModel->getAllPrescription('prescription');
           
			$load->view('prescription/all_prescription' , $allPrescriptionOrder);
		}
	
		public function getPrescriptionById(){
			$load              = new Pres_load();
			$labTestModel         = $load->model('model_prescription');
			$id                = $_GET['id'];
			$allPrescriptionOrder['allprescription'] = $labTestModel->getByIdPrescription('prescription',$id);
            
			$load->view('prescription/edit_prescription' , $allPrescriptionOrder);
		}
		public function updatePrescription(){
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
		public function deletePrescription(){
			$load             	 = new Pres_load();
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
	
	    public function prescription_settings_page() {
			?>
			<div class="wrap">
			<h1>Prescription setting page</h1>

			<form method="post" action="options.php">
			    <?php settings_fields( 'prescription-settings-group' ); ?>
			    <?php do_settings_sections( 'prescription-settings-group' ); ?>
			    <table class="form-table">
			        <tr valign="top">
			        <th scope="row">After Submit order sending email account</th>
			        <td><input type="text" name="set_email_account" value="<?php echo esc_attr( get_option('set_email_account') ); ?>" /></td>
			        </tr>
			         
			        <tr valign="top">
			        <th scope="row">Admin list page title</th>
			        <td><input type="text" name="list_page_title" value="<?php echo esc_attr( get_option('list_page_title') ); ?>" /></td>
			        </tr>
			        
			        <tr valign="top">
			        <th scope="row">Service name</th>
			        <td><input type="text" name="service_name" value="<?php echo esc_attr( get_option('service_name') ); ?>" /></td>
			        </tr>
			    </table>
			    
			    <?php submit_button(); ?>

			</form>
			</div>
			<?php } 
}