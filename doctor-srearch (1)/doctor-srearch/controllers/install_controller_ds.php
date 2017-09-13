<?php
class Install_controller_ds
{
	var $db_version = "1.1";
	
	public function __construct()
	{
		global $wpdb;
		
	}
	
	public function activate()
	{
		
		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		
		add_option('ds_db_version', $this->db_version);
		
		
	
	} 
	
	public function deactivate()
	{
		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		
		add_option('ds_db_version', $this->db_version);
			

	}
}