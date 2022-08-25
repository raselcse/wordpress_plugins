<?php
/**
* 
*/
class Report extends OplController
{
	
	function __construct(){
		parent::__construct();
	}
    

	public function reportList(){
		//$this->load->view('report/report-list.php');
	}

	public function totalClickView($advertisement_id){
        
		$advetisementModel = $this->load->model('AdvertisementModel');
	
	}

	public function advertisementAvailableNextMonth(){
        
		$advetisementModel = $this->load->model('AdvertisementModel');
		
	}

	public function advertisementAvailableCurrentMonth(){
        
		$advetisementModel = $this->load->model('AdvertisementModel');
		
	}


	public function advertisementLimitOver(){
	
	}

	public function advertisementListByType(){
	 
	}
    
        public	function opl_report_submenu() {
			
			
			add_submenu_page('advertisement', 
							'Report ', 
							'Report',
							'manage_options', 
							'reports',
							array( 'Report','reportList') 
							);
			add_submenu_page('Report', 
							'report List', 
							'report List',
							'manage_options', 
							'report-list',
							array( 'Report','Report') 
							);	
		
			
		}
}