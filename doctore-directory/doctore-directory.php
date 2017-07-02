<?php
/*
Plugin Name: Doctor Directory
Plugin URI: http://oployeelabs.com
Description: Declares a plugin that will create a custom post type displaying all doctor list.
Version: 1.0
Author: Rasel
Author URI: http://raselsec.com
*/

add_action('init','create_doctor_directory');

function create_doctor_directory(){
	 register_post_type( 'doctor_directory',
        array(
            'labels' => array(
                'name' => 'Doctor Directories',
                'singular_name' => 'Doctor Directory',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Doctor Directory',
                'edit' => 'Edit',
                'edit_item' => 'Edit Doctor Directory',
                'new_item' => 'New Doctor Directory',
                'view' => 'View',
                'view_item' => 'View Doctor Directory',
                'search_items' => 'Search Doctor Directories',
                'not_found' => 'No Doctor Directories found',
                'not_found_in_trash' => 'No Doctor Directories found in Trash',
                'parent' => 'Parent Doctor Directory'
            ),
 
            'public' => true,
            'menu_position' => 15,
			'publicly_queryable' => true,
			'query_var' => true,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail'),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-admin-users',
            'has_archive' => true,
			'rewrite' => array('slug' => 'doctorlist', 'with_front' => true ),
			
        )
    );
	
	
}

add_action( 'admin_init', 'my_admin' );
	function my_admin() {
		add_meta_box( 'doctor_directory_meta_box',
			'Doctor Directory Details',
			'display_doctor_directory_meta_box',
			'doctor_directory', 'normal', 'high'
		);
	}
	
	function display_doctor_directory_meta_box( $doctor_directory ) {
		// Retrieve current name of the Director and Movie Rating based on review ID
		$doctor_designation = esc_html( get_post_meta( $doctor_directory->ID, 'doctor_designation', true ) );
		$doctor_fee = esc_html( get_post_meta( $doctor_directory->ID, 'doctor_fee', true ) );
		$doctor_chamber_address = esc_html( get_post_meta( $doctor_directory->ID, 'doctor_chamber_address', true ) );
		?>
		<table>
			<tr>
				<td style="width: 100%">Doctor designation</td>
				<td><input type="text" size="80" name="doctor_designation" value="<?php echo $doctor_designation; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 150px">Doctor fee</td>
				 <td><input type="text" size="80" name="doctor_fee" value="<?php echo $doctor_fee; ?>" /></td>
			   
			</tr>
			<tr>
				<td style="width: 150px">Doctor Chamber Address</td>
				 <td><textarea  name="doctor_chamber_address"> <?php echo $doctor_chamber_address; ?></textarea></td>
			   
			</tr>
		</table>
    <?php
	}

	add_action( 'save_post', 'add_doctor_directory_fields', 10, 2 );
    function add_doctor_directory_fields( $doctor_directory_id, $doctor_directory ) {
		// Check post type for movie reviews
		if ( $doctor_directory->post_type == 'doctor_directory' ) {
			// Store data in post meta table if present in post data
			if ( isset( $_POST['doctor_designation'] ) && $_POST['doctor_designation'] != '' ) {
				update_post_meta( $doctor_directory_id, 'doctor_designation', $_POST['doctor_designation'] );
			}
			if ( isset( $_POST['doctor_fee'] ) && $_POST['doctor_fee'] != '' ) {
				update_post_meta( $doctor_directory_id, 'doctor_fee', $_POST['doctor_fee'] );
			}
		    if ( isset( $_POST['doctor_chamber_address'] ) && $_POST['doctor_chamber_address'] != '' ) {
				update_post_meta( $doctor_directory_id, 'doctor_chamber_address', $_POST['doctor_chamber_address'] );
			}
			 
		}
	}
	
add_action( 'init', 'create_doctor_taxonomies', 0 );

	// create two taxonomies, Doctors and writers for the post type "book"
	function create_doctor_taxonomies() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Specialists', 'taxonomy general name', 'textdomain' ),
			'singular_name'     => _x( 'Specialist', 'taxonomy singular name', 'textdomain' ),
			'search_items'      => __( 'Search Specialists', 'textdomain' ),
			'all_items'         => __( 'All Specialists', 'textdomain' ),
			'parent_item'       => __( 'Parent Specialist', 'textdomain' ),
			'parent_item_colon' => __( 'Parent Specialist:', 'textdomain' ),
			'edit_item'         => __( 'Edit Specialist', 'textdomain' ),
			'update_item'       => __( 'Update Specialist', 'textdomain' ),
			'add_new_item'      => __( 'Add New Specialist', 'textdomain' ),
			'new_item_name'     => __( 'New Specialist Name', 'textdomain' ),
			'menu_name'         => __( 'Specialist', 'textdomain' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'Specialist' ),
		);

		register_taxonomy( 'Specialist', array( 'doctor_directory' ), $args );

		
	}
	
	add_filter( 'template_include', 'include_template_function', 1 );
	
	/**
 * Proper way to enqueue scripts and styles
 */
// register jquery and style on initialization
add_action('init', 'doctor_directory_register_script');
function doctor_directory_register_script() {
    //wp_register_script( 'custom_jquery', plugins_url('/js/custom-jquery.js', __FILE__), array('jquery'), '2.5.1' );

    wp_register_style( 'doctor_directory_style', plugins_url('/css/doctor_list_style.css', __FILE__), false, '1.0.0', 'all');
}

// use the registered jquery and style above
add_action('wp_enqueue_scripts', 'doctor_directory_enqueue_style');

function doctor_directory_enqueue_style(){
   //wp_enqueue_script('custom_jquery');

   wp_enqueue_style( 'doctor_directory_style' );
}
	
	function include_template_function( $template_path ) {
    if ( get_post_type() == 'doctor_directory' ) {
        if ( !is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'doctors_list.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/doctors_list.php';
            }
        }
		else{
			 $template_path = plugin_dir_path( __FILE__ ) . '/single_doctor.php';
			}
    }
    return $template_path;
}

function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
	'nopaging' => true,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}
add_filter( 'redirect_canonical', 'custom_disable_redirect_canonical' );
function custom_disable_redirect_canonical( $redirect_url ) {
    if ( is_paged() && is_singular() ) $redirect_url = false; 
    return $redirect_url; 
}
?>