<?php
class Install_controller
{
	var $db_version = "1.1";
	var $tables;
	
	public function __construct()
	{
		global $wpdb;
		
		$this->tables = array(
				'advertise_types' 	=> $wpdb->prefix.'advertise_types',
				'advertises' 		=> $wpdb->prefix.'advertises'
		);
	}
	
	public function activate()
	{
			
		//$this->activate_app(__FILE__);
		
		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		
		add_option('opl_ad_db_version', $this->db_version);
		
		$table_advertise_types = $this->tables['advertise_types'];
		
		$sql_advertise_types = "CREATE TABLE ".$table_advertise_types." (
			id int(11) NOT NULL auto_increment,
			title varchar(255) NOT NULL,
			width varchar(6) NOT NULL DEFAULT '125',
			height varchar(6) NOT NULL DEFAULT '125',
			description text NULL,
			status int(2) NOT NULL DEFAULT '1',
			shortcode varchar(255) default '[type]',
			PRIMARY KEY  (id)
		  )";
		dbDelta($sql_advertise_types);
		
		
		$table_advertises = $this->tables['advertises'];
		
		$sql_advertises = '
		  CREATE TABLE '.$table_advertises.' (
			id int(11) NOT NULL auto_increment,
			ad_name varchar(255) NOT NULL,
			advertise_type_id int(11) NOT NULL,
			image varchar(255) NOT NULL,
			link varchar(500)  NULL,
			categories varchar(500)  NULL,
			page varchar(500)  NULL,
			schedule_type int(2) NOT NULL DEFAULT "1",
			start_date DATE NOT NULL,
			end_date DATE NULL,
			max_view int(11) NOT NULL DEFAULT "0",
			max_click int(11) NOT NULL DEFAULT "0",
			view_count int(11) NOT NULL DEFAULT "0",
			click_count int(11) NOT NULL DEFAULT "0",
			computer char(1) NOT NULL DEFAULT "Y",
			mobile char(1) NOT NULL DEFAULT "Y",
			tablet char(1) NOT NULL DEFAULT "Y",
			ios_mobile char(1) NOT NULL DEFAULT "Y",
			android_mobile char(1) NOT NULL DEFAULT "Y",
			others_mobile char(1) NOT NULL DEFAULT "Y",
			archive int(2) NOT NULL DEFAULT "0",
			status int(2) NOT NULL DEFAULT "1",
			PRIMARY KEY  (id),
			KEY advertise_type_id (advertise_type_id)
		  )';
		dbDelta($sql_advertises);
	} 
	
	public function deactivate()
	{
		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		
		add_option('opl_ad_db_version', $this->db_version);
			
			$table_advertises = $this->tables['advertises'];
		    $table_advertise_types = $this->tables['advertise_types'];
			$wpdb->query("DROP TABLE IF EXISTS ".$table_advertises."");
			$wpdb->query("DROP TABLE IF EXISTS ".$table_advertise_types."");

	}
}