<?php
	Class Advertisement_type extends OplController{
		public function __construct(){
			parent::__construct();
		}
		public function opl_advertise_types_area_shortcode($atts, $content = null) {
    
			extract(shortcode_atts(array(
				"id" =>'1',
				"class" =>'class-name',
				"width" =>'120px',
				"height" =>'120px',
			), $atts));
			
			
			$load       = new Load();
			$typeModel  = $load->model('advertisementType');
			$type_data  = $typeModel->getById_type('advertise_types',$id);
			$class      = $type_data["0"]->title;
			$class_name = str_replace(' ', '_', $class);
			$height     = $type_data["0"]->height;
			$width      = $type_data["0"]->width;

          
			$advertiseModel = $load->model('advertisementModel');
			 global $post;
             $categories = get_the_category( $post->ID ); 
             $cat_id     = $categories[0]->term_id;
			 $advertisement_data = $advertiseModel->getByAdvertisementWhere('advertises', 'categories' , $cat_id);
            
             
			//$advertisement_data = $advertiseModel->getAdByMultipleWhere('advertises','advertise_types','advertise_type_id','id','categories', $cat_id);
            //var_dump($advertisement_data);
			$link       = $advertisement_data["0"]->link;
			$imagesrc   = $advertisement_data["0"]->image;
			$ad_id      = $advertisement_data["0"]->id;
			$type_id      = $advertisement_data["0"]->advertise_type_id;
          
            $schedule   = new Schedule();
			$availableWithDate = $schedule->dateCheck($ad_id);
		    $clickLimit = $schedule->clickCounterLimit($ad_id);
		    $viewLimit  = $schedule->viewCounterLimit($ad_id);
            $schedule_id = $schedule->getAdScheduleType($ad_id);

            if(is_single()){
	            $detect = new Mobile_Detect;
	 
				// Any mobile device (phones or tablets).
			
			    
			    if($schedule_id == '1'){

				    if($availableWithDate)
				    {
				    	return '<div id="opl-admanager-block" advertisement_id="'.$ad_id.'"class="'.$class_name.'" style="width:'.$width.'px; height:'.$height.'px">
							<a style="display:block;" href="'.$link .'" target="_blink"> <img src="'.$imagesrc.'" alt="Smiley face"/></a>
							</div> 
							';	
				    }
				    else{
				    	return '<div id="opl-admanager-not-available">Not Available Date for this Advertisement</div>';
				    }
				}

				elseif ($schedule_id == '2') {
					

				    if($viewLimit)
				    {
				    	return '<div id="opl-admanager-block" advertisement_id="'.$ad_id.'"class="'.$class_name.'" style="width:'.$width.'px; height:'.$height.'px">
							<a style="display:block;" href="'.$link .'" target="_blink"> <img src="'.$imagesrc.'" alt="Smiley face"/></a>
							</div> 
							';	
				    }
				    else{
				    	return '<div id="opl-admanager-not-available">View Limit has exceed for this Advertisement</div>';
				    }
				}

				elseif ($schedule_id == '3') {
					

				    if($clickLimit)
				    {
				    	return '<div id="opl-admanager-block" advertisement_id="'.$ad_id.'"class="'.$class_name.'" style="width:'.$width.'px; height:'.$height.'px">
							<a style="display:block;" href="'.$link .'" target="_blink"> <img src="'.$imagesrc.'" alt="Smiley face"/></a>
							</div> 
							';	
				    }
				    else{
				    	return '<div id="opl-admanager-not-available">Maximum Click Limit has exceed for this Advertisement</div>';
				    }
				}

			}
		}
		public function opl_admin_submenu(){
		    add_submenu_page('advertisement', 
							'Advertisement Type', 
							'Advertisement Type',
							'manage_options', 
							'advertisement_type',
							array( 'Advertisement_type','getAllAdvertisementType') 
							);
			add_submenu_page('advertisement', 
							'Add New Advertisement Type', 
							'Add New Advertisement Type',
							'manage_options', 
							'add_advertisement_type',
							array( 'Advertisement_type','add_new') 
							);
			add_submenu_page('For Saving data', 
							'', 
							'',
							'manage_options', 
							'save_new_type',
							array( 'Advertisement_type','save_new_type') 
							);	
			add_submenu_page('Get data for Update data', 
							'', 
							'',
							'manage_options', 
							'getForUpdateType',
							array( 'Advertisement_type','getTypeById') 
							);	
			add_submenu_page('for Update data', 
							'', 
							'',
							'manage_options', 
							'update_type',
							array( 'Advertisement_type','update_type') 
							);
			add_submenu_page('for Delete data', 
							'', 
							'',
							'manage_options', 
							'deleteType',
							array( 'Advertisement_type','deleteType') 
							);	
		}
		public function add_new(){
			$load = new Load();
			//$this->load->view('type/add_new_type');
			
			$load->view('type/add_new_type');
			//var_dump($this->load->test());	
			//var_dump($this->test);
		}
		
		public function save_new_type(){
			 $title        = $_REQUEST['title'];
			 $width        = $_REQUEST['width'];
			 $height       = $_REQUEST['height'];
			 $description  = $_REQUEST['description'];
			 $data         = array();
			 $data['title']=$title;
			 $data['width']=$width;
			 $data['height']=$height;
			 $data['description']=$description;
			 $load         = new Load();
			 $typeModel    = $load->model('AdvertisementType');
			 $success_insert = $typeModel->save_type('advertise_types' , $data);
			$msg = array();
			if($success_insert){
				$msg['success_msg'] = "Data has been added";
			}
			else{
				$msg['error_msg'] = "Cannot added data to server";
			}
			$load->view('type/add_new_type' , $msg);
		}
		
		public function getAllAdvertisementType(){
			$load          = new Load();
			$typeModel     = $load->model('AdvertisementType');
			
			$allTypes['types'] = $typeModel->getAll_type('advertise_types');
           
			$load->view('type/all_type' , $allTypes);
		}
		
		public function getTypeById(){
			$load        = new Load();
			$typeModel   = $load->model('AdvertisementType');
			$id          = $_GET['id'];
			$allTypes['types'] = $typeModel->getById_type('advertise_types',$id);
           
			$load->view('type/edit_type' , $allTypes);
		}
		public function update_type(){
		     $id         = $_REQUEST['id'];
			 $title      = $_REQUEST['title'];
			 $width      = $_REQUEST['width'];
			 $height     = $_REQUEST['height'];
			 $description = $_REQUEST['description'];
			 $data       = array();
			 $data['title']=$title;
			 $data['width']=$width;
			 $data['height']=$height;
			 $data['description']=$description;
			 $load       = new Load();
			 $typeModel  = $load->model('AdvertisementType');
			 $success_insert = $typeModel->update_type('advertise_types',$data,$id);
			$msg = array();
			if($success_insert){
				$msg['success_msg'] = "Data has been Update";
			}
			else{
				$msg['error_msg'] = "Not Updated";
			}
			$allTypes['types'] = $typeModel->getAll_type('advertise_types');
			$load->view('type/edit_type' ,$allTypes, $msg);
		}
		public function deleteType(){
			$load       = new Load();
			$typeModel  = $load->model('AdvertisementType');
			$id         = $_GET['id'];
			$deleteType = $typeModel->deleteById_type('advertise_types',$id);
			$allTypes['types'] = $typeModel->getAll_type('advertise_types');
			$msg        = array();
			if($deleteType){
				$msg['success_msg'] = "Data has been Deleted";
			}
			else{
				$msg['error_msg'] = "Not Deleted";
			}
            $load->view('type/all_type' , $allTypes, $msg);
		}
    }