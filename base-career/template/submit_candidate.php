<?php get_header();
	if ( ! empty( $_POST ) ) {
		global $wpdb;


		$tablename=$wpdb->prefix.'candidate';
		$data=array(
			'name' => $_POST['name'], 
			'date_of_birth' => $_POST['date_of_birth'],
			'gender' => $_POST['gender'], 
			'district' => $_POST['district'],
			'natinality' => $_POST['natinality'], 
			'religion' => $_POST['religion'], 
			'nationalid_or_passport' => $_POST['nationalid_or_passport'], 
			'career_objective' => $_POST['career_objective'],
			'total_experience' => $_POST['total_experience'], 
			'preferred_level_position' => $_POST['preferred_level_position'], 
			'available_for' => $_POST['available_for'], 
			'present_salary' => $_POST['present_salary'],
			'expected_salary' => $_POST['expected_salary'], 
			'marital_status' => $_POST['marital_status'], 
			'phone_no' => $_POST['phone_no'], 
			'email' => $_POST['email'],
			'present_address' => $_POST['present_address'], 
			'permanent_address' => $_POST['permanant_address'],
			'source_of_application' => $_POST['source_of_application']
			);

		var_dump($data);
		 //$wpdb->insert( $tablename, $data);
	}

?>

<?php 
get_footer();
?>
