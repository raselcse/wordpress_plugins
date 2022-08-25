<?php
/**
* 
*/
class Schedule extends OplController
{
	
	function __construct(){
		parent::__construct();
	}

	public function dateCheck($advertisement_id){
        
		$advetisementModel = $this->load->model('AdvertisementModel');
		$startEndDate      = $advetisementModel->getStartEndDate('advertises','start_date, end_date',$advertisement_id);
        
        $start_date        = $startEndDate['0']->start_date;

		$end_date          = $startEndDate['0']->end_date;

		$current_date      = date('Y-m-d');

        return $this->check_in_date_range($start_date, $end_date, $current_date);
	}

	public function clickCounterLimit($advertisement_id){
        
		$advetisementModel = $this->load->model('AdvertisementModel');
		$getDataArray      = $advetisementModel->getMaximumClick('advertises','max_click , click_count',$advertisement_id);
        
        $max_click         = $getDataArray['0']->max_click;
        $present_click     = $getDataArray['0']->click_count;

        return $this->check_click_count($max_click, $present_click);
	}

	public function viewCounterLimit($advertisement_id){
        
		$advetisementModel = $this->load->model('AdvertisementModel');
		$getDataArray      = $advetisementModel->getMaximumView('advertises','max_view , view_count',$advertisement_id);
        
        $max_view          = $getDataArray['0']->max_view;
        $present_view      = $getDataArray['0']->view_count;

        return $this->check_view_count($max_view, $present_view);
	}


	public function check_in_date_range($start_date, $end_date, $current_date){
		// Convert to timestamp
		$start_ts 	      = strtotime($start_date);
		$end_ts 	      = strtotime($end_date);
		$user_ts 	      = strtotime($current_date);

		// Check that user date is between start & end
		return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
	}

	public function check_view_count($max_view_limit, $present_view_total){
	  // Check that maximum click limit
	  return ($present_view_total <= $max_view_limit);
	}

	public function check_click_count($max_click_limit, $present_click_total){
	  // Check that maximum click limit
	  return ($present_click_total <= $max_click_limit);
	}


	public function getAdScheduleType($advertisement_id){

		$advetisementModel  = $this->load->model('AdvertisementModel');
		$scheduleArray      = $advetisementModel->getScheduletype('advertises','schedule_type',$advertisement_id);
        
        $schedule_id        = $scheduleArray['0']->schedule_type;

        return $schedule_id;
	}
}