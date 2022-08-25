<?php
/*
Plugin Name: Doctor's Search Bangladesh
Plugin URI: http://www.oployeelabs.com
Description: Search your desire doctor from doctorola.com.
Author: OployeeLabs LTD.
Version: 1.0.0
Author URI: http://www.oployeelabs.com
*/

register_activation_hook(__FILE__,'ds_admin_activator');
register_deactivation_hook(__FILE__,'ds_admin_deactivator');


include_once dirname(__FILE__).'/core/controller/ds_controller.php';
include_once dirname(__FILE__).'/core/controller/ds_load.php';
include_once dirname(__FILE__).'/core/database/ds_database.php';
include_once dirname(__FILE__).'/core/model/ds_model.php';
include_once dirname(__FILE__).'/controllers/doctorsearch.php';
include_once dirname(__FILE__).'/searchWidget.php';

function ds_admin_activator(){
	global $wp_rewrite;
	include_once dirname(__FILE__).'/controllers/install_controller_ds.php';
	$loader = new Install_controller_ds();
	$loader->activate();
	$wp_rewrite->flush_rules( true );
}

function ds_admin_deactivator(){
	global $wp_rewrite;
	include_once  dirname(__FILE__).'/controllers/install_controller_ds.php';
	$loader = new Install_controller_ds();
	$loader->deactivate();
	$wp_rewrite->flush_rules( true );
}


add_action( 'admin_menu', array('Doctorsearch', 'ds_admin_menu'));

add_shortcode('doctor_search_form', array('Doctorsearch', 'doctor_search_form'));


function ds_css_and_js() {
	
	wp_register_style('ds_ad_css', plugins_url('public/css/main.css',__FILE__ ));
	wp_enqueue_style('ds_ad_css');
	
	// wp_deregister_script('jquery');
	// wp_register_script('jquery', plugins_url( 'public/js/jquery-min.js', __FILE__ ) ,array(), null, true);
	// wp_enqueue_script('jquery');

	wp_register_script( 'ds_custom_js', plugins_url( 'public/js/custom.js', __FILE__ ), array( 'jquery' ));
	wp_enqueue_script('ds_custom_js');
	wp_localize_script( 'ds_custom_js', 'actionUrl', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	
}


add_action( 'admin_init','ds_css_and_js');
add_action( 'init','ds_css_and_js');

//add_filter('widget_text','do_shortcode');

function custom_css_validation( $input ) {
    if ( ! empty( $input['ds_custom_css'] ) )
        $input['ds_custom_css'] = trim( $input['ds_custom_css'] );
    return $input;
}
add_action( 'admin_init', 'register_ds_settings' );
function register_ds_settings() {
    //register our settings
    register_setting( 'ds-settings-group', 'ds_sub_title' );
    register_setting( 'ds-settings-group', 'ds_button_text' );
    register_setting( 'ds-settings-group', 'ds_button_text_color' );
    register_setting( 'ds-settings-group', 'ds_button_background_color' );
    register_setting( 'ds-settings-group', 'ds_custom_css' ,'custom_css_validation' );
}

add_action( 'wp_head', 'display_custom_css' );
 
function display_custom_css() {
		?>
	<?php
	$custom_css = get_option( 'ds_custom_css' );
	if ( ! empty( $custom_css ) ) { ?>
	<style type="text/css">
		<?php
		echo '/* Custom CSS */' . "\n";
		echo $custom_css . "\n";
		?>
	</style>
		<?php
	}
}
?>