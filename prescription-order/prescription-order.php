<?php
/*
Plugin Name: Prescription Order
Plugin URI: http://www.oployeelabs.com
Description: Prescription Order use to manage all Prescription.
Author: OployeeLabs LTD.
Version: 1.0.0
Author URI: http://www.oployeelabs.com
*/

register_activation_hook(__FILE__,'prescription_admin_activator');
register_deactivation_hook(__FILE__,'prescription_admin_deactivator');


include_once dirname(__FILE__).'/core/controller/pres_controller.php';
include_once dirname(__FILE__).'/core/controller/pres_load.php';
include_once dirname(__FILE__).'/core/database/pres_database.php';
include_once dirname(__FILE__).'/core/model/pres_model.php';
include_once dirname(__FILE__).'/controllers/prescription.php';
function prescription_admin_activator(){
	global $wp_rewrite;
	include_once dirname(__FILE__).'/controllers/install_controller_prescription.php';
	$loader = new Install_controller_prescription();
	$loader->activate();
	$wp_rewrite->flush_rules( true );
}

function prescription_admin_deactivator(){
	global $wp_rewrite;
	include_once  dirname(__FILE__).'/controllers/install_controller_prescription.php';
	$loader = new Install_controller_prescription();
	$loader->deactivate();
	$wp_rewrite->flush_rules( true );
}


/**
 * Register a custom menu page.
 */
//add_action( 'init', array('Advertisement_type','add_new'));

add_action( 'admin_menu', array('Prescription', 'prescription_admin_menu'));
add_action( 'admin_menu', array('Prescription', 'prescription_admin_submenu'));

add_shortcode('prescription_form', array('Prescription', 'add_new_prescription'));
//add_shortcode('discount_search', array('dc_lab_test', 'discount_list_one_search_lab_test'));
// //add_filter ('the_content', array('Advertisement', 'opl_advertise_area_auto_create'));


function prescription_css_and_js() {
	wp_register_style('prescription_ad_css', plugins_url('public/css/main.css',__FILE__ ));
	wp_enqueue_style('prescription_ad_css');
	wp_register_script( 'prescription_custom_js', plugins_url( 'public/js/custom.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('prescription_custom_js');
	
	wp_localize_script( 'prescription_custom_js', 'actionUrl', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	
}


add_action( 'admin_init','prescription_css_and_js');
add_action( 'init','prescription_css_and_js');

add_action('wp_ajax_prescription_form_submit','prescription_form_submit');
add_action('wp_ajax_nopriv_prescription_form_submit', 'prescription_form_submit');

function prescription_form_submit(){
	$prescription_title = $_POST['pres_title'];
	$prescription_description = $_POST['pres_description'];
	$pres_user_id = $_POST['pres_user_id'];
	$pres_user_name = $_POST['pres_user_name'];
	$pres_user_email = $_POST['pres_user_email'];
	$pres_user_phone = $_POST['pres_user_phone'];
	$pres_notification_email = $_POST['pres_notification_email'];
	$data             = array();
	$data['prescription_title']  = $prescription_title;
	$data['prescription_description']= $prescription_description;
	$data['user_id']= $pres_user_id;
	$data['user_name']= $pres_user_name;
	$data['user_email']= $pres_user_email;
	$data['user_mobile']= $pres_user_phone;
   
	
	
	$parent_post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : 0;  // The parent ID of our attachments
    $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg"); // Supported file types
    $max_file_size = 1024 * 500; // in kb
    $max_image_upload = 10; // Define how many images can be uploaded to the current post
    $wp_upload_dir = wp_upload_dir();
    $path = $wp_upload_dir['path'] . '/';
    $count = 0;

    $attachments = get_posts( array(
        'post_type'         => 'attachment',
        'posts_per_page'    => -1,
        'post_parent'       => $parent_post_id,
        'exclude'           => get_post_thumbnail_id() // Exclude post thumbnail to the attachment count
    ) );

    // Image upload handler
    if( $_SERVER['REQUEST_METHOD'] == "POST" ){
        
        // Check if user is trying to upload more than the allowed number of images for the current post
        if( ( count( $attachments ) + count( $_FILES['files']['name'] ) ) > $max_image_upload ) {
            $upload_message[] = "Sorry you can only upload " . $max_image_upload . " images for each Ad";
        } else {
            
            foreach ( $_FILES['files']['name'] as $f => $name ) {
                $extension = pathinfo( $name, PATHINFO_EXTENSION );
                // Generate a randon code for each file name
                $new_filename = $pres_user_name  . '_' .prescription_generate_random_code(5). '_order_file.' . $extension;
                
                if ( $_FILES['files']['error'][$f] == 4 ) {
                    continue; 
                }
                
                if ( $_FILES['files']['error'][$f] == 0 ) {
                    // Check if image size is larger than the allowed file size
                    if ( $_FILES['files']['size'][$f] > $max_file_size ) {
                        $upload_message[] = "$name is too large!.";
                        continue;
                    
                    // Check if the file being uploaded is in the allowed file types
                    } elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
                        $upload_message[] = "$name is not a valid format";
                        continue; 
                    
                    } else{ 
                        // If no errors, upload the file...
                        if( move_uploaded_file( $_FILES["files"]["tmp_name"][$f], $path.$new_filename ) ) {
                            
                            $count++; 

                            $filename = $path.$new_filename;
                            $filetype = wp_check_filetype( basename( $filename ), null );
                            $wp_upload_dir = wp_upload_dir();
                            $attachment = array(
                                'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
                                'post_mime_type' => $filetype['type'],
                                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
                                'post_content'   => '',
                                'post_status'    => 'inherit'
                            );
                            // Insert attachment to the database
                            $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

                            require_once( ABSPATH . 'wp-admin/includes/image.php' );
                            
                            // Generate meta data
                            $attach_data = wp_generate_attachment_metadata( $attach_id, $filename ); 
                            wp_update_attachment_metadata( $attach_id, $attach_data );
                            
                        }
                    }
                }
            }
        }
    }
   
	$data['prescription_file']= $filename;
	$data['prescription_media_id']= $attach_id;
    $load = new Pres_load();
	$labTestModel = $load->model('model_prescription');
	$success_insert = $labTestModel->savePrescription('prescription' , $data);
	var_dump($pres_notification_email);
	$msg['success_msg'] = "Your Prescription order request has been submitted";
		$to = 'raselsec@gmail.com';
		$subject = 'The subject';
		$body = 'The email body content';
		//$headers[] = 'From: Me Myself <me@example.net>';
		//$headers[] = 'Cc: John Q Codex <jqc@wordpress.org>';
		//$headers[] = 'Cc: iluvwp@wordpress.org'; // note you can just use a simple email address
		 
		//wp_mail( $to, $subject, $body, $headers );
		wp_mail( $to, $subject, $body );
	$msg = array();
	if($success_insert){
		$msg['success_msg'] = "Your Prescription order request has been submitted";
		$to = 'raselsec@gmail.com';
		$subject = 'The subject';
		$body = 'The email body content';
		$headers[] = 'From: Me Myself <me@example.net>';
		$headers[] = 'Cc: John Q Codex <jqc@wordpress.org>';
		$headers[] = 'Cc: iluvwp@wordpress.org'; // note you can just use a simple email address
		 
		//wp_mail( $to, $subject, $body, $headers );
		wp_mail( $to, $subject, $body );
	}
	else{
		$msg['error_msg'] = "Prescription order request has not submitted";
	}
	
}


// Random code generator used for file names.
function prescription_generate_random_code($length=10) {
 
   $string = '';
   $characters = "23456789";
 
   for ($p = 0; $p < $length; $p++) {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
 
   return $string;
 
}
function prescription_file_thumbnail_view($media_id){
		$image_attributes = wp_get_attachment_image_src( $media_id , 'full');
		$image_url =  $image_attributes[0];
		$image_width =  $image_attributes[1];
		$image_height=  $image_attributes[2];
		?>
		<a href="<?php echo $image_url?>" target="_blink"><img width="120" height="120" src="<?php echo $image_url; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" />
		</a>
<?php }

function prescription_file_full_view($prescription_media_id){
		$image_attributes = wp_get_attachment_image_src( $prescription_media_id , 'full' );
		$image_url =  $image_attributes[0];
		$image_width =  $image_attributes[1];
		$image_height=  $image_attributes[2];
		?>
		<a href="<?php echo $image_url?>" target="_blink"><img src="<?php echo $image_url; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" />
		</a>
<?php }?>

<?php


add_action( 'admin_init', 'register_prescription_settings' );
function register_prescription_settings() {
    //register our settings
    register_setting( 'prescription-settings-group', 'set_email_account' );
    register_setting( 'prescription-settings-group', 'list_page_title' );
    register_setting( 'prescription-settings-group', 'service_name' );
}

