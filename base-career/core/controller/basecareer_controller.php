<?php
	class Basecareer_controller{
		protected $load ;
		function __construct(){
		   $this->load = new Basecareer_load();
		}

		public function opl_ad_is_mobile() {
			
			$detect = new pres_mobile_detect;
			if($detect->isMobile() AND !$detect->isTablet()) {
				return true;
			}
			return false;
		}

		public function opl_ad_is_tablet() {
			
			$detect = new pres_mobile_detect;
			 
			if($detect->isTablet()) {
				return true;
			}
			return false;
		}
	}