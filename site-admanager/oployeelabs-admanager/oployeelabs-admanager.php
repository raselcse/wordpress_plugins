<?php
/*
Plugin Name: OployeeLabs Add Manager
Plugin URI: http://www.oployeelabs.com
Description: Ad Manager use to manage advertisement.
Author: OployeeLabs LTD.
Version: 1.0.0
Author URI: http://www.oployeelabs.com
*/

register_activation_hook(__FILE__,'adman_activator');
register_deactivation_hook(__FILE__,'adman_deactivator');


include_once dirname(__FILE__).'/core/controller/oplController.php';
include_once dirname(__FILE__).'/core/controller/load.php';
include_once dirname(__FILE__).'/core/database/oplDatabase.php';
include_once dirname(__FILE__).'/core/model/oplModel.php';
include_once dirname(__FILE__).'/controllers/advertisement.php';
include_once dirname(__FILE__).'/controllers/advertisement_type.php';
include_once dirname(__FILE__).'/controllers/schedule.php';
include_once dirname(__FILE__).'/controllers/report.php';
include_once dirname(__FILE__).'/core/libs/Opl_Mobile_Detect.php';
//include_once dirname(__FILE__).'/controllers/WPMU.php';
function adman_activator(){
	global $wp_rewrite;
	include_once dirname(__FILE__).'/controllers/install_controller.php';
	$loader = new install_controller();
	$loader->activate();
	$wp_rewrite->flush_rules( true );
}

function adman_deactivator(){
	global $wp_rewrite;
	include_once  dirname(__FILE__).'/controllers/install_controller.php';
	$loader = new install_controller();
	$loader->deactivate();
	$wp_rewrite->flush_rules( true );
}


/**
 * Register a custom menu page.
 */
//add_action( 'init', array('Advertisement_type','add_new'));

add_action( 'admin_menu', array('Advertisement', 'opl_admin_menu'));
add_action( 'admin_menu', array('Advertisement', 'opl_admin_submenu'));
add_action( 'admin_menu', array('Advertisement_type', 'opl_admin_submenu'));
add_action( 'admin_menu', array('Report', 'opl_report_submenu'));

add_shortcode('type', array('Advertisement_type', 'opl_advertise_types_area_shortcode'));
add_filter ('the_content', array('Advertisement', 'opl_advertise_area_auto_create'));


function opl_css_and_js() {
	wp_register_style('opl_ad_css', plugins_url('public/css/main.css',__FILE__ ));
	wp_enqueue_style('opl_ad_css');
     
    wp_register_script( 'schedule_js', plugins_url( 'public/js/schedule_type.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('schedule_js');
	

	wp_register_script( 'opl_ad_js', plugins_url( 'public/js/counter_advertisement.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('opl_ad_js');
	
	wp_localize_script( 'opl_ad_js', 'countad', array(
						'ajax_url' => admin_url( 'admin-ajax.php' )
					));


}


add_action( 'admin_init','opl_css_and_js');
add_action( 'init','opl_css_and_js');



add_action( 'wp_ajax_counter_advertisement',  array('Advertisement', 'counter_advertisement') );
add_action( 'wp_ajax_nopriv_counter_advertisement',  array('Advertisement', 'counter_advertisement') );
//store session data when registration

add_action( 'wp_ajax_view_counter_advertisement',  array('Advertisement', 'view_counter_advertisement') );
add_action( 'wp_ajax_nopriv_view_counter_advertisement',  array('Advertisement', 'view_counter_advertisement') );


