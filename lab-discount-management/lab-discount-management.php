<?php
/*
Plugin Name: Lab Discount Management system
Plugin URI: http://www.oployeelabs.com
Description: Lab Discount Management system use to manage all offer of Diagnostic Center.
Author: OployeeLabs LTD.
Version: 1.0.0
Author URI: http://www.oployeelabs.com
*/

register_activation_hook(__FILE__,'admin_activator');
register_deactivation_hook(__FILE__,'admin_deactivator');


include_once dirname(__FILE__).'/core/controller/oplController.php';
include_once dirname(__FILE__).'/core/controller/load.php';
include_once dirname(__FILE__).'/core/database/oplDatabase.php';
include_once dirname(__FILE__).'/core/model/oplModel.php';
include_once dirname(__FILE__).'/controllers/lab_test.php';
include_once dirname(__FILE__).'/controllers/diagnostic_center.php';
include_once dirname(__FILE__).'/controllers/dc_lab_test.php';
include_once dirname(__FILE__).'/setting_page.php';
function admin_activator(){
	global $wp_rewrite;
	include_once dirname(__FILE__).'/controllers/install_controller_ltms.php';
	$loader = new install_controller_ltms();
	$loader->activate();
	$wp_rewrite->flush_rules( true );
}

function admin_deactivator(){
	global $wp_rewrite;
	include_once  dirname(__FILE__).'/controllers/install_controller_ltms.php';
	$loader = new install_controller_ltms();
	$loader->deactivate();
	$wp_rewrite->flush_rules( true );
}


/**
 * Register a custom menu page.
 */
//add_action( 'init', array('Advertisement_type','add_new'));

add_action( 'admin_menu', array('lab_test', 'opl_admin_menu'));
add_action( 'admin_menu', array('lab_test', 'opl_admin_submenu'));
add_action( 'admin_menu', array('diagnostic_center', 'opl_admin_submenu'));
add_action( 'admin_menu', array('dc_lab_test', 'opl_admin_submenu'));

add_shortcode('lab_test_list', array('lab_test', 'lab_test_list_shortcode'));
add_shortcode('discount_search', array('dc_lab_test', 'discount_list_one_search_lab_test'));
// //add_filter ('the_content', array('Advertisement', 'opl_advertise_area_auto_create'));


function opl_css_and_js() {
	wp_register_style('opl_ad_css', plugins_url('public/css/main.css',__FILE__ ));
	wp_enqueue_style('opl_ad_css');
	wp_register_script( 'custom_js', plugins_url( 'public/js/custom.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('custom_js');


}


add_action( 'admin_init','opl_css_and_js');
add_action( 'init','opl_css_and_js');
