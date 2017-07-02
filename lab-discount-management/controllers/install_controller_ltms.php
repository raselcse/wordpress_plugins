<?php
class Install_controller_ltms
{
	var $db_version = "1.1";
	var $tables;
	
	public function __construct()
	{
		global $wpdb;
		
		$this->tables = array(
				'diagnostic_center' 	=> $wpdb->prefix.'diagnostic_center',
				'lab_test' 		=> $wpdb->prefix.'lab_test',
				'dc_lab_test' 		=> $wpdb->prefix.'dc_lab_test'
		);
	}
	
	public function activate()
	{
		
		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		
		add_option('dc_lab_test_db_version', $this->db_version);
		$table_lab_test = $this->tables['lab_test'];
		
		
		$sql_lab_test = "CREATE TABLE ".$table_lab_test." (
			id int(11) NOT NULL auto_increment,
			lab_test_name varchar(255) NOT NULL,
			lab_test_description text NULL,
			lab_test_status int(2) NOT NULL DEFAULT '1',
			PRIMARY KEY  (id)
		  )";
		dbDelta($sql_lab_test);
		
		$table_diagnostic_center = $this->tables['diagnostic_center'];
		
		
		$sql_diagnostic_center = '
		CREATE TABLE '.$table_diagnostic_center.' (
			id int(11) NOT NULL auto_increment,
			dc_name varchar(255) NOT NULL,
			dc_address text NULL,
			dc_description text  NULL,
			dc_status int(2) NOT NULL DEFAULT "1",
			PRIMARY KEY  (id)
		)';
		dbDelta($sql_diagnostic_center);
		
		$table_dc_lab_test = $this->tables['dc_lab_test'];
		$sql_dc_lab_test = '
		  CREATE TABLE '.$table_dc_lab_test.'(
			id int(11) NOT NULL auto_increment,
			dc_id int(11) NOT NULL,
			lab_test_id int(11) NOT NULL,
			discount_name varchar(255) NOT NULL,
			test_price int(11) NOT NULL,
			discount_amount varchar(255) NULL,
			discount_coupon varchar(255) NULL,
			discount_description text NULL,
			discount_status int(2) NOT NULL DEFAULT "1",
			PRIMARY KEY  (id)
		  )';
		dbDelta($sql_dc_lab_test);
	} 
	
	public function deactivate()
	{
		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		
		add_option('dc_lab_test_db_version', $this->db_version);
			
		$table_lab_test = $this->tables['lab_test'];
		$table_diagnostic_center = $this->tables['diagnostic_center'];
		$table_dc_lab_test = $this->tables['dc_lab_test'];
		$wpdb->query("DROP TABLE IF EXISTS ".$table_lab_test."");
		$wpdb->query("DROP TABLE IF EXISTS ".$table_diagnostic_center."");
		$wpdb->query("DROP TABLE IF EXISTS ".$table_dc_lab_test."");

	}
}