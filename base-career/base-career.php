<?php
/*
Plugin Name:Base Career Plugins 
Plugin URI: http://www.oployeelabs.com
Description: A Complete Career system.
Author: OployeeLabs LTD.
Version: 1.0.0
Author URI: http://www.oployeelabs.com
*/

register_activation_hook(__FILE__,'basecareer_admin_activator');
register_deactivation_hook(__FILE__,'basecareer_admin_deactivator');


include_once dirname(__FILE__).'/core/controller/basecareer_controller.php';
include_once dirname(__FILE__).'/core/controller/basecareer_load.php';
include_once dirname(__FILE__).'/core/database/basecareer_database.php';
include_once dirname(__FILE__).'/core/model/basecareer_model.php';



include_once dirname(__FILE__).'/controllers/candidate.php';
include_once dirname(__FILE__).'/controllers/candidate_experience.php';
include_once dirname(__FILE__).'/controllers/candidate_academic_qualification.php';
include_once dirname(__FILE__).'/controllers/candidate_professional_qualification.php';
include_once dirname(__FILE__).'/controllers/candidate_reference.php';
include_once dirname(__FILE__).'/controllers/candidate_file.php';
include_once dirname(__FILE__).'/controllers/job.php';
include_once dirname(__FILE__).'/controllers/cv.php';
function basecareer_admin_activator(){
	global $wp_rewrite;
	include_once dirname(__FILE__).'/controllers/install_controller_basecareer.php';
	$loader = new Install_controller_basecareer();
	$loader->activate();
	$wp_rewrite->flush_rules( true );
}

function basecareer_admin_deactivator(){
	global $wp_rewrite;
	include_once  dirname(__FILE__).'/controllers/install_controller_basecareer.php';
	$loader = new Install_controller_basecareer();
	$loader->deactivate();
	$wp_rewrite->flush_rules( true );
}


/**
 * Register a custom menu page.
 */
//add_action( 'init', array('Advertisement_type','add_new'));

function basecareer_css_and_js() {
	//wp_register_style('basecareer_bootstrap_css', plugins_url('public/css/bootstrap.min.css',__FILE__ ));
	// wp_register_style('basecareer_font_css', plugins_url('public/css/font-awesome.min.css',__FILE__ ));
	// wp_register_style('basecareer_animate_css', plugins_url('public/css/animate.css',__FILE__ ));
	// wp_register_style('basecareer_fancybox_css', plugins_url('public/css/jquery.fancybox.css',__FILE__ ));
	// wp_register_style('basecareer_flexmenu_css', plugins_url('public/css/jquery.flexmenu.css',__FILE__ ));
	// wp_register_style('basecareer_nouislider_css', plugins_url('public/css/jquery.nouislider.css',__FILE__ ));
	// wp_register_style('basecareer_carousel_css', plugins_url('public/css/owl.carousel.css',__FILE__ ));
	wp_register_style('basecareer_ad_css', plugins_url('public/css/style.css',__FILE__ ));
	wp_enqueue_style('basecareer_ad_css');
	
	// wp_register_script( 'basecareer_modernizr_js', plugins_url( 'public/js/modernizr.custom.79639.js', __FILE__ ));
	// wp_enqueue_script('basecareer_modernizr_js');
	
	
	
	

	// wp_register_script( 'basecareer_bootstrap_js', plugins_url( 'public/js/bootstrap.min.js', __FILE__ ) , array('jquery'));
	// wp_enqueue_script('basecareer_bootstrap_js');
	
	// wp_register_script( 'basecareer_retina_js', plugins_url( 'public/js/retina.min.js', __FILE__ ) , array('jquery'));
	// wp_enqueue_script('basecareer_retina_js');
	
	// wp_register_script( 'basecareer_scrollReveal_js', plugins_url( 'public/js/scrollReveal.min.js', __FILE__ ) , array('jquery'));
	// wp_enqueue_script('basecareer_scrollReveal_js');
	
	// wp_register_script( 'basecareer_flexmenu_js', plugins_url( 'public/js/jquery.flexmenu.js', __FILE__ ) , array('jquery'));
	// wp_enqueue_script('basecareer_flexmenu_js');
	
	// wp_localize_script( 'basecareer_custom_js', 'actionUrl', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	
}


add_action( 'admin_init','basecareer_css_and_js');
add_action( 'init','basecareer_css_and_js');


$candidateController = new Candidate();
add_action( 'admin_menu', array($candidateController, 'candidate_admin_menu'));
add_action( 'admin_menu', array($candidateController, 'candidate_admin_submenu'));


// Candidate Save
add_action('admin_post_nopriv_submit_candidate', array($candidateController, 'saveCandidate'));
add_action('admin_post_submit_candidate', array($candidateController, 'saveCandidate'));

$experienceController = new Candidate_experience();
add_action('admin_post_nopriv_submit_candidate', array($experienceController, 'saveExperience'));
add_action('admin_post_submit_candidate', array($experienceController, 'saveExperience'));

$academicQualificationController = new Candidate_academic_qualification();

add_action('admin_post_nopriv_submit_candidate', array($academicQualificationController, 'saveAcademicQualification'));
add_action('admin_post_submit_candidate', array($academicQualificationController, 'saveAcademicQualification'));

$professionalQualficationController = new Candidate_professional_qualification();

add_action('admin_post_nopriv_submit_candidate', array($professionalQualficationController, 'saveProfessionalQualification'));
add_action('admin_post_submit_candidate', array($professionalQualficationController, 'saveProfessionalQualification'));

$referenceController = new Candidate_reference();

add_action('admin_post_nopriv_submit_candidate', array($referenceController, 'saveReference'));
add_action('admin_post_submit_candidate', array($referenceController, 'saveReference'));


// $cvController = new Cv();

// add_action('init', array($cvController, 'getCvByUserId'));

add_action('admin_post_nopriv_update_cv', array($cvController, 'updateCV'));
add_action('admin_post_submit_update_cv', array($cvController, 'updateCV'));


add_filter( 'template_include', 'include_apply_job_template_function', 1 );
add_filter( 'template_include', 'include_all_job_template_function', 1 );
add_filter( 'template_include', 'include_submit_candidate_template_function', 1 );
add_filter( 'template_include', 'include_cv_edit_template_function', 1 );

function include_apply_job_template_function( $template_path ) {
    if (is_page('create-cv') ) {
        
		$template_path = plugin_dir_path( __FILE__ ) . '/template/candidate_apply_job.php';
			
    }
    return $template_path;
}

function include_cv_edit_template_function( $template_path ) {
    if (is_page('edit-my-cv') ) {
        
		$template_path = plugin_dir_path( __FILE__ ) . '/template/candidate_profile_edit.php';
			
    }
    return $template_path;
}

function include_all_job_template_function( $template_path ) {
    if (is_page('all-job') ) {
        
		$template_path = plugin_dir_path( __FILE__ ) . '/template/all-job.php';
			
    }
    return $template_path;
}

function include_submit_candidate_template_function( $template_path ) {
    if (is_page('submit-candidate') ) {
        
		$template_path = plugin_dir_path( __FILE__ ) . '/template/submit_candidate.php';
			
    }
    return $template_path;
}









