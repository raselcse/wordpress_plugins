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
			'candidate_acadecmic' 	=> $wpdb->prefix.'candidate_acadecmic',
			'candidate_reference' 	=> $wpdb->prefix.'candidate_reference',
		);
	}
	
	public function activate()
	{
		
		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		
		add_option('basecareer_db_version', $this->db_version);
	
		$table_candidate = $this->tables['candidate'];
		
		$sql_candidate = "CREATE TABLE ".$table_candidate." (
			id int(11) NOT NULL auto_increment,
			name varchar(255) NULL,
			date_of_birth varchar(255) NOT NULL,
			gender varchar(255) NOT NULL,
			discrict varchar(255) NOT NULL,
			nationality varchar(255) NOT NULL,
			religion varchar(255) NULL,
			national_id int(2) NOT NULL,
			phone_no varchar(255) NOT NULL,
			email varchar(255) NOT NULL,
			marital_status varchar(255) NOT NULL,
			present_address text(500) NULL,
			permanent_address text(500) NULL,
			preferred_level_position varchar(255) NOT NULL,
			available_for varchar(255) NOT NULL,
			present_salery int(20) NULL,
			expected_salery int(20) NULL,
			source_of_application varchar(255) NULL,
			career_objective varchar(255) NULL,
			total_experience varchar(255) NULL,
			username varchar(255) NULL NOT NULL,
			password varchar(255) NULL NOT NULL,
			PRIMARY KEY  (id)
		  )";
		 dbDelta($sql_candidate); 
		 
		$table_job = $this->tables['job']; 
		$sql_job = "CREATE TABLE ".$table_job." (
			id int(11) NOT NULL auto_increment,
			title varchar(255) NULL,
			location varchar(255) NULL,
			region varchar(255) NULL,
			type varchar(255) NOT NULL,
			category varchar(255) NOT NULL,
			description text(1000) NOT NULL,
			application_email varchar(255) NULL,
			PRIMARY KEY  (id)
		)";
		dbDelta($sql_job);
		
		$table_candidate_experience = $this->tables['candidate_experience'];
		$sql_candidate_experience = "CREATE TABLE ".$table_candidate_experience." (
			id int(11) NOT NULL auto_increment,
			candidate_id int(11) NOT NULL,
			company_name varchar(255) NOT NULL,
			Designation varchar(255) NOT NULL,
			Responsibility varchar(255) NULL,
			start_date datetime DEFAULT '0000-00-00 00:00:00' NULL,
			end_date datetime DEFAULT '0000-00-00 00:00:00' NULL,
			PRIMARY KEY  (id)
		)";
		dbDelta($sql_candidate_experience);
		
		$table_candidate_acadecmic = $this->tables['candidate_acadecmic '];
		$sql_candidate_acadecmic = "CREATE TABLE ".$table_candidate_acadecmic." (
			id int(11) NOT NULL auto_increment,
			candidate_id int(11) NOT NULL,
			exam_name varchar(255) NOT NULL,
			institution_name varchar(255) NOT NULL,
			subject varchar(255) NULL,
			board varchar(255) NULL,
			passing_year varchar(255) NULL,
			result_type varchar(255) NULL,
			cgpa varchar(255) NULL,
			number varchar(255) NULL,
			PRIMARY KEY  (id)
		)";
		dbDelta($sql_candidate_acadecmic);
		
		$table_candidate_reference = $this->tables['candidate_reference'];
		$sql_candidate_reference = "CREATE TABLE ".$table_candidate_reference." (
			id int(11) NOT NULL auto_increment,
			candidate_id int(11) NOT NULL,
			full_name int(11) NOT NULL,
			designation_company_address varchar(255) NOT NULL,
			relationship varchar(255) NOT NULL,
			mobile varchar(255) NULL,
			email varchar(255) NULL,
			PRIMARY KEY  (id)
		)";
		dbDelta($sql_candidate_reference);
		
		$table_candidate_file = $this->tables['candidate_file'];
		$sql_candidate_file = "CREATE TABLE ".$table_candidate_file." (
			id int(11) NOT NULL auto_increment,
			candidate_id int(11) NOT NULL,
			file_name VARCHAR( 30 ) NOT NULL
			content MEDIUMBLOB NOT NULL 
			PRIMARY KEY  (id)
		)";
		dbDelta($sql_candidate_reference);
		
	
	} 
	
	public function deactivate()
	{
		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		add_option('basecareer_db_version', $this->db_version);
			
		$table_candidate = $this->tables['candidate'];
		$table_job = $this->tables['job'];
	    // $wpdb->query("DROP TABLE IF EXISTS ".$table_candidate."");
		// $wpdb->query("DROP TABLE IF EXISTS ".$table_job."");

	}
}