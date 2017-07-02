<?php
class Install_controller_prescription
{
	var $db_version = "1.1";
	var $tables;
	
	public function __construct()
	{
		global $wpdb;
		
		$this->tables = array(
				'prescription' 	=> $wpdb->prefix.'prescription'
		);
	}
	
	public function activate()
	{
		
		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		
		add_option('prescription_db_version', $this->db_version);
		$table_prescription = $this->tables['prescription'];
		
		
		$sql_prescription = "CREATE TABLE ".$table_prescription." (
			id int(11) NOT NULL auto_increment,
			prescription_title varchar(255) NULL,
			prescription_description text(500) NULL,
			user_id int(11) NOT NULL,
			user_name varchar(255) NOT NULL,
			user_email varchar(255) NOT NULL,
			user_mobile varchar(255) NOT NULL,
			prescription_file varchar(255) NOT NULL,
			prescription_media_id int(11) NOT NULL,
			prescription_order_status int(2) NOT NULL DEFAULT 'pendding',
			PRIMARY KEY  (id)
		  )";
		dbDelta($sql_prescription);
		
	
	} 
	
	public function deactivate()
	{
		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		
		add_option('prescription_db_version', $this->db_version);
			
		$table_prescription = $this->tables['prescription'];
		$wpdb->query("DROP TABLE IF EXISTS ".$table_prescription."");

	}
}