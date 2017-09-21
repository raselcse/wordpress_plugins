<?php
class Install_controller_basecareer
{
	var $db_version = "1.1";
	var $tables;
	
	public function __construct()
	{
		global $wpdb;
		
		$this->tables = array(
			'candidate' 	=> $wpdb->prefix.'candidate',
			'job' 	=> $wpdb->prefix.'job',
			'candidate_experience' 	=> $wpdb->prefix.'candidate_experience',
			'candidate_academic_qualification' 	=> $wpdb->prefix.'candidate_academic_qualification',
			'candidate_professional_qualification' 	=> $wpdb->prefix.'candidate_professional_qualification',
			'candidate_reference' 	=> $wpdb->prefix.'candidate_reference',
			'candidate_file' 	=> $wpdb->prefix.'candidate_file',
		);
	}
	
	public function activate()
	{
		
		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		
		add_option('basecareer_db_version', $this->db_version);
	
		$table_candidate = $this->tables['candidate'];
		
		$sql_candidate = "CREATE TABLE ".$table_candidate." (
			id int(11) NOT NULL auto_increment,
			candidate_userid int(11) NOT NULL,
			name varchar(255) NULL,
			date_of_birth varchar(255) NULL,
			gender varchar(255) NULL,
			district varchar(255) NULL,
			nationality varchar(255) NULL,
			religion varchar(255) NULL,
			nationalid_or_passport varchar(255) NULL,
			phone_no varchar(255) NULL,
			email varchar(255) NULL,
			marital_status varchar(255) NULL,
			present_address text(500) NULL,
			permanent_address text(500) NULL,
			preferred_level_position varchar(255) NULL,
			available_for varchar(255) NULL,
			present_salary int(20) NULL,
			expected_salary int(20) NULL,
			source_of_application varchar(255) NULL,
			career_objective varchar(255) NULL,
			total_experience varchar(255) NULL,
			PRIMARY KEY  (id)
		  )";
		 dbDelta($sql_candidate); 
		 
		$table_job = $this->tables['job']; 
		$sql_job = "CREATE TABLE ".$table_job."(
			id int(11) NOT NULL auto_increment,
			title varchar(255) NULL,
			location varchar(255) NULL,
			region varchar(255) NULL,
			type varchar(255) NOT NULL,
			category varchar(255) NOT NULL,
			description text(1000) NOT NULL,
			PRIMARY KEY  (id)
		)";
		dbDelta($sql_job);
		
		$table_apply_job = $this->tables['apply_job']; 
		$sql_apply_job = "CREATE TABLE ".$table_job."(
			id int(11) NOT NULL auto_increment,
			job_id int(11) NOT NULL,
			candidate_id int(11) NULL,
			expected_salary_for_job double(100) NULL,
			apply_date datetime(255) NOT NULL,
			PRIMARY KEY  (id)
		)";
		dbDelta($sql_apply_job);
		
		$table_candidate_experience = $this->tables['candidate_experience'];
		$sql_candidate_experience = "CREATE TABLE ".$table_candidate_experience." (
			id int(11) NOT NULL auto_increment,
			candidate_userid int(11) NOT NULL,
			company_name varchar(255) NOT NULL,
			designation varchar(255) NOT NULL,
			responsibility varchar(255) NULL,
			start_date datetime  NULL,
			end_date datetime  NULL,
			PRIMARY KEY  (id)
		)";
		dbDelta($sql_candidate_experience);
		
		$table_candidate_academic_qualification = $this->tables['candidate_academic_qualification '];
		$sql_candidate_academic_qualification = "CREATE TABLE ".$table_candidate_academic_qualification." (
			id int(11) NOT NULL auto_increment,
			candidate_userid int(11) NOT NULL,
			examination varchar(255) NULL,
			school varchar(255) NULL,
			board varchar(255) NULL,
			subject varchar(255) NULL,
			result float(50) NULL,
			subject_group varchar(255) NULL,
			passing_year year(50) NULL,
			PRIMARY KEY  (id)
		)";
		dbDelta($sql_candidate_academic_qualification);
		
		$table_candidate_professional_qualification = $this->tables['candidate_professional_qualification '];
		$sql_candidate_professional_qualification = "CREATE TABLE ".$table_candidate_professional_qualification." (
			id int(11) NOT NULL auto_increment,
			candidate_userid int(11) NOT NULL,
			title varchar(255) NULL,
			institute_name varchar(255) NULL,
			duration varchar(255) NULL,
			address varchar(255) NULL,
			PRIMARY KEY  (id)
		)";
		dbDelta($sql_candidate_professional_qualification);
		
		$table_candidate_reference = $this->tables['candidate_reference'];
		$sql_candidate_reference = "CREATE TABLE ".$table_candidate_reference." (
			id int(11) NOT NULL auto_increment,
			candidate_userid int(11) NOT NULL,
			full_name varchar(255) NULL,
			designation_company_address varchar(255) NULL,
			relationship varchar(255) NULL,
			mobile varchar(255) NULL,
			email varchar(255) NULL,
			PRIMARY KEY  (id)
		)";
		dbDelta($sql_candidate_reference);
		
		$table_candidate_file = $this->tables['candidate_file'];
		$sql_candidate_file = "CREATE TABLE ".$table_candidate_file." (
			id int(11) NOT NULL auto_increment,
			candidate_userid int(11) NOT NULL,
			file_name VARCHAR( 30 ) NOT NULL,
			content MEDIUMBLOB NOT NULL ,
			PRIMARY KEY  (id)
		)";
		dbDelta($sql_candidate_file);
		
	
	} 
	
	public function deactivate()
	{
		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		add_option('basecareer_db_version', $this->db_version);
			
		// $table_candidate = $this->tables['candidate'];
		// $table_job = $this->tables['job'];

	}
}