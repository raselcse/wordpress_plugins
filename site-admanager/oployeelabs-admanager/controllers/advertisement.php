<?php
	class Advertisement extends OplController{
		
		function __construct()
		{
			parent::__construct();
		}

	
		public function opl_advertise_area_auto_create($content) {
   
			
			
			$load       = new Load();
			
			$advertiseModel = $load->model('advertisementModel');
			global $post;
             $categories = get_the_category( $post->ID ); 
             $cat_id     = $categories[0]->term_id;
			 $advertisement_data = $advertiseModel->getByAdvertisementWhere('advertises', 'categories' , $cat_id);
            
           
			$link       = $advertisement_data["0"]->link;
			$imagesrc   = $advertisement_data["0"]->image;
			$ad_id      = $advertisement_data["0"]->id;
			$type_id    = $advertisement_data["0"]->advertise_type_id;
			$computer    = $advertisement_data["0"]->computer;
			$mobile    = $advertisement_data["0"]->mobile;
			$tablet    = $advertisement_data["0"]->tablet;
            
            $typeModel  = $load->model('advertisementType');
			$type_data  = $typeModel->getById_type('advertise_types',$type_id);
			$class      = $type_data["0"]->title;
			$class_name = str_replace(' ', '_', $class);
			$height     = $type_data["0"]->height;
			$width      = $type_data["0"]->width;

            $schedule   = new Schedule();
			$availableWithDate = $schedule->dateCheck($ad_id);
		    $clickLimit = $schedule->clickCounterLimit($ad_id);
		    $viewLimit  = $schedule->viewCounterLimit($ad_id);
            $schedule_id = $schedule->getAdScheduleType($ad_id);

           
 
			// Any mobile device (phones or tablets).
			if(is_single()){
				$mobile_controller = new OplController();
				
		    	$mobile_device= $mobile_controller->opl_ad_is_mobile();
		    	$tablet_device= $mobile_controller->opl_ad_is_tablet();
		 
			    if($mobile =='N'){
			    	if($mobile_device){
			    		return $content;  
                          exit();
			    	}
			    }

			    elseif($tablet =='N'){
			    	if($tablet_device){
			    		return $content;
                        exit();
			    	}
			    }
			   elseif($computer =='N'){
			    	if(!$tablet_device && !$mobile_device){
			    	   return $content;
                       exit();
			    	}
			    }
              

			    if($schedule_id == '1'){

				    if($availableWithDate)
				    {
				        	 $custom_content = '<div id="opl-admanager-block" advertisement_id="'.$ad_id.'"class="'.$class_name.'" style="width:'.$width.'px; height:'.$height.'px">
							<a style="display:block;" href="'.$link .'" target="_blink"> <img src="'.$imagesrc.'" alt="Smiley face"/></a>
							</div>';
						    $custom_content .= $content;
				    		
				    }
				    else{

				    	 $custom_content = '<div id="opl-admanager-not-available">Not Available Date for this Advertisement</div>';
						    $custom_content .= $content;
				    	
				    }
				}

				elseif ($schedule_id == '2') {
					

				    if($viewLimit)
				    {

				    	 $custom_content = '<div id="opl-admanager-block" advertisement_id="'.$ad_id.'"class="'.$class_name.'" style="width:'.$width.'px; height:'.$height.'px">
							<a style="display:block;" href="'.$link .'" target="_blink"> <img src="'.$imagesrc.'" alt="Smiley face"/></a>
							</div>';
						    $custom_content .= $content;

				    	
				    }
				    else{
				    		$custom_content = '<div id="opl-admanager-not-available">View Limit has exceed for this Advertisement</div>';
						    $custom_content .= $content;
				    	
				    }
				}

				elseif ($schedule_id == '3') {
					

				    if($clickLimit)
				    {
				    	 $custom_content = '<div id="opl-admanager-block" advertisement_id="'.$ad_id.'"class="'.$class_name.'" style="width:'.$width.'px; height:'.$height.'px">
							<a style="display:block;" href="'.$link .'" target="_blink"> <img src="'.$imagesrc.'" alt="Smiley face"/></a>
							</div>';
						    $custom_content .= $content;

				    	
				    }
				    else{
				    	   $custom_content = '<div id="opl-admanager-not-available">Maximum Click Limit has exceed for this  Advertisement</div>';
						    $custom_content .= $content;

				    }
				}

				else{

					return $content;
				}
				return $custom_content;
			}
		}

	    public	function opl_admin_menu() {
			add_menu_page(
				__( 'OployeeLabs Advertisement'),
				'OployeeLabs Advertisement',
				'manage_options',
				'advertisement',
				array( 'Advertisement','getAllAdvertisement') ,
				'',
				plugins_url( 'myplugin/images/icon.png' ),
				6
			);
		}
		public	function opl_admin_submenu() {
			
			
			add_submenu_page('advertisement', 
							'Add New Advertisement ', 
							'Add New Advertisement',
							'manage_options', 
							'add_advertisement',
							array( 'Advertisement','add_new_advertisement') 
							);
			add_submenu_page('For Saving data', 
							'', 
							'',
							'manage_options', 
							'saveAdvertisement',
							array( 'Advertisement','saveAdvertisement') 
							);	
			add_submenu_page('Get data for Update data', 
							'', 
							'',
							'manage_options', 
							'getAdvertisementById',
							array( 'Advertisement','getAdvertisementById') 
							);	
			add_submenu_page('for Update data', 
							'', 
							'',
							'manage_options', 
							'updateAdvertisement',
							array( 'Advertisement','updateAdvertisement') 
							);
			add_submenu_page('for Delete data', 
							'', 
							'',
							'manage_options', 
							'deleteAdvertisement',
							array( 'Advertisement','deleteAdvertisement') 
							);	
			
		}
		
		public function add_new_advertisement(){
			$load              = new Load();
			$typeModel         = $load->model('AdvertisementType');
			
			$allTypes['types'] = $typeModel->getField_type('advertise_types','id,title');

			$load->view('advertisement/add_new_advertisement',$allTypes);
			//$table_advertise_types = $this->tables['advertise_types'];
			
		}
		
		public function saveAdvertisement(){
			 $ad_name          = $_REQUEST['ad_name'];
			 $image            = $_REQUEST['image'];
			 $link             = $_REQUEST['link'];
			 $AdvertiseType_id = $_REQUEST['AdvertiseType_id'];
			 $categories       = $_REQUEST['categories'];
			 $schedule_type    = $_REQUEST['schedule_type'];
			 $start_date       = $_REQUEST['start_date'];
			 $end_date         = $_REQUEST['end_date'];
			 $max_view         = $_REQUEST['max_view'];
			 $max_click        = $_REQUEST['max_click'];
			 $opl_ad_desktop   = isset($_REQUEST['opl_ad_desktop']) ? 'Y' : 'N';
			 $opl_ad_mobile   = isset($_REQUEST['opl_ad_mobile']) ? 'Y' : 'N';
			 $opl_ad_tablet   = isset($_REQUEST['opl_ad_tablet']) ? 'Y' : 'N';
			 $opl_ad_ios   = isset($_REQUEST['opl_ad_ios']) ? 'Y' : 'N';
			 $opl_ad_android   = isset($_REQUEST['opl_ad_android']) ? 'Y' : 'N';
			 $opl_ad_other   = isset($_REQUEST['opl_ad_other']) ? 'Y' : 'N';
			  
			 $data             = array();
			 $data['ad_name']  =$ad_name;
			 $data['advertise_type_id']=$AdvertiseType_id;
			 $data['image']     =$image;
			 $data['link']      =$link;
			 $data['categories']=$categories;
			 $data['schedule_type']=$schedule_type;
			 $data['start_date']=$start_date;
			 $data['end_date']  =$end_date;
			 $data['max_view']  =$max_view;
			 $data['max_click'] =$max_click;
			 $data['computer'] =$opl_ad_desktop;
			 $data['mobile'] =$opl_ad_mobile;
			 $data['tablet'] =$opl_ad_tablet;
			 $data['ios_mobile'] =$opl_ad_ios;
			 $data['android_mobile'] =$opl_ad_android;
			 $data['others_mobile'] =$opl_ad_other;
			 $load = new Load();
			 $typeModel = $load->model('AdvertisementModel');
			 $success_insert = $typeModel->save_advertisement('advertises' , $data);
			$msg = array();
			if($success_insert){
				$msg['success_msg'] = "Data has been added";
			}
			else{
				$msg['error_msg'] = "Cannot added data to server";
			}
			$load->view('advertisement/add_new_advertisement' , $msg);
		}
		
		public function getAllAdvertisement(){
			$load              = new Load();
			$typeModel         = $load->model('AdvertisementModel');
			$allTypes['types'] = $typeModel->getAll_advertisement('advertises');
           
			$load->view('advertisement/all_advertisement' , $allTypes);
		}
		
		public function getActiveAllAdvertisement(){
			$load              = new Load();
			$typeModel         = $load->model('AdvertisementModel');
			$allTypes['types'] = $typeModel->getActiveAllAdvertisement('advertises','status', 1);
           
			$load->view('advertisement/all_advertisement' , $allTypes);
		}

		public function getAdvertisementById(){
			$load              = new Load();
			$typeModel         = $load->model('AdvertisementModel');
			$id                = $_GET['id'];
			$allTypes['types'] = $typeModel->getById_advertisement('advertises',$id);
            $AdvertisementType = $load->model('AdvertisementType');
			
			$adTypes['adtypes'] = $AdvertisementType->getField_type('advertise_types','id,title');
			$load->view('advertisement/edit_advertisement' , $allTypes , $adTypes);
		}
		public function updateAdvertisement(){
		     $id               = $_REQUEST['id'];
			 $ad_name          = $_REQUEST['ad_name'];
			 $image            = $_REQUEST['image'];
			 $link             = $_REQUEST['link'];
			 $AdvertiseType_id = $_REQUEST['AdvertiseType_id'];
			 $categories       = $_REQUEST['categories'];
			 $schedule_type    = $_REQUEST['schedule_type'];
			 $start_date       = $_REQUEST['start_date'];
			 $end_date         = $_REQUEST['end_date'];
			 $max_view         = $_REQUEST['max_view'];
			 $max_click        = $_REQUEST['max_click'];
			 $opl_ad_desktop   = isset($_REQUEST['opl_ad_desktop']) ? 'Y' : 'N';
			 $opl_ad_mobile   = isset($_REQUEST['opl_ad_mobile']) ? 'Y' : 'N';
			 $opl_ad_tablet   = isset($_REQUEST['opl_ad_tablet']) ? 'Y' : 'N';
			 $opl_ad_ios   = isset($_REQUEST['opl_ad_ios']) ? 'Y' : 'N';
			 $opl_ad_android   = isset($_REQUEST['opl_ad_android']) ? 'Y' : 'N';
			 $opl_ad_other   = isset($_REQUEST['opl_ad_other']) ? 'Y' : 'N';

			 $data             = array();
			 $data['ad_name']  =$ad_name;
			 $data['advertise_type_id']=$AdvertiseType_id;
			 $data['image']    =$image;
			 $data['link']     =$link;
			 $data['categories']=$categories;
			 $data['schedule_type']=$schedule_type;
			 $data['start_date']=$start_date;
			 $data['end_date'] =$end_date;
			 $data['max_view'] =$max_view;
			 $data['max_click']=$max_click;
			 $data['computer'] =$opl_ad_desktop;
			 $data['mobile'] =$opl_ad_mobile;
			 $data['tablet'] =$opl_ad_tablet;
			 $data['ios_mobile'] =$opl_ad_ios;
			 $data['android_mobile'] =$opl_ad_android;
			 $data['others_mobile'] =$opl_ad_other;

			 $load = new Load();
			 $typeModel = $load->model('AdvertisementModel');
			 $success_update = $typeModel->update_advertisement('advertises',$data,$id);
			$msg = array();
			if($success_update){
				$msg['success_msg'] = "Data has been Updated";

			}
			else{
				$msg['error_msg'] = "Not Updated";
			}
			$allTypes['types'] = $typeModel->getAll_advertisement('advertises');
			$load->view('advertisement/edit_advertisement' ,$allTypes, $msg);
		}
		public function deleteAdvertisement(){
			$load              = new Load();
			$typeModel         = $load->model('AdvertisementModel');
			$id                = $_GET['id'];
			$deleteType        = $typeModel->deleteById_advertisement('advertises',$id);
			$allTypes['types'] = $typeModel->getAll_advertisement('advertises');
			$msg = array();
			if($deleteType){
				$msg['success_msg'] = "Data has been Deleted";
			}
			else{
				$msg['error_msg'] = "Not Deleted";
			}
            $load->view('advertisement/all_advertisement' , $allTypes, $msg);
		}

		public function counter_advertisement(){
			$advertisment_id     = $_POST['advertisment_id'];
			$count               =  $_POST['count'];
			
			$load                = new Load();
			$adModel             = $load->model('AdvertisementModel');
			$present_count_array = $adModel->getByAdvertisementWhere( 'advertises' , 'id' , $advertisment_id );
			$present_click_count = $present_count_array['0']->click_count;
			$now_click_amount    = $present_click_count+$count;
			//var_dump($present_count[0]);
			$data = array();
			$data['click_count'] = $now_click_amount;
		    $count_increament    = $adModel->update_counter_advertisement('advertises',$data,$advertisment_id);
			
			// Always die in functions echoing ajax content
  			die();

		}

		public function view_counter_advertisement(){
			$advertisment_id     = $_POST['advertisment_id'];
			$count               =  $_POST['count'];
			
			$load                = new Load();
			$adModel             = $load->model('AdvertisementModel');
			$present_count_array = $adModel->getByAdvertisementWhere( 'advertises' , 'id' , $advertisment_id );
			$present_view_count  = $present_count_array['0']->view_count;
			$now_view_amount     = $present_view_count+$count;
			//var_dump($present_count[0]);
			$data                = array();
			$data['view_count']  = $now_view_amount;
		    $count_increament    = $adModel->update_counter_advertisement('advertises',$data,$advertisment_id);
			
			// Always die in functions echoing ajax content
  			die();

		}

	
}