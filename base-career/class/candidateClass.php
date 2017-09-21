<?php	
if(!class_exists('Link_List_Table')){
 
   require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
 
}
class Basecareer_candidate_list extends WP_List_Table {

	function __construct(){
		global $status, $page;                

		parent::__construct( array(
			'singular'  => 'Candidate',  
			'plural'    => 'Candidates list',   
			'ajax'      => true      
		) );        
	}
    
    /** * Prepare the items for the table to process 
	* * @return Void 
	*/
	public function prepare_items()
	{
			// $this->_column_headers = $this->get_column_info();
		$columns = $this->get_columns();
		$hidden = $this->get_hidden_columns();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array(
			$columns,
			$hidden,
			$sortable
		);
		/** Process bulk action */
		$this->process_bulk_action();
		$per_page = $this->get_items_per_page('records_per_page', 10);
		$current_page = $this->get_pagenum();
		$total_items = self::record_count();
		$data = self::get_records($per_page, $current_page);
		$this->set_pagination_args(
						  ['total_items' => $total_items, //WE have to calculate the total number of items
					   'per_page' => $per_page // WE have to determine how many items to show on a page
					  ]);
		$this->items = $data;
	}
	
	
	public static function get_records($per_page = 10, $page_number = 1)
	{
		global $wpdb;
		$candidate_table = $wpdb->prefix.'candidate';
		$sql = "select * from $candidate_table";
		if (isset($_REQUEST['s'])) {
		$sql.= ' where column1 LIKE "%' . $_REQUEST['s'] . '%" or column2 LIKE "%' . $_REQUEST['s'] . '%"';
		}
		if (!empty($_REQUEST['orderby'])) {
				$sql.= ' ORDER BY ' . esc_sql($_REQUEST['orderby']);
			$sql.= !empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
		}
		$sql.= " LIMIT $per_page";
		$sql.= ' OFFSET ' . ($page_number - 1) * $per_page;
		$result = $wpdb->get_results($sql, 'ARRAY_A');
		return $result;
	}
	
	/** 
	* Override the parent columns method. Defines the columns to use in your listing table 
	* * @return Array 
	*/
	function get_columns()
	{
		$columns = [
			'cb' => '<input type="checkbox" />', 
			'name' => __('Name', 'ux') , 
			'email' => __('Email', 'ux') , 
			'gender' => __('Gender', 'ux') , 
			'marital_status' => __('Merital Status', 'ux') , 
			'expected_salary' => __('Expected Salary', 'ux') , 
			'phone_no' => __('Phone No', 'ux') , 
			'total_experience' => __('Total Experience', 'ux')  
		];
		return $columns;
	}
	function column_default( $item, $column_name ) {
	  switch( $column_name ) { 
		case 'name':
		case 'email':
		case 'gender':
		case 'marital_status':
		case 'expected_salary':
		case 'phone_no':
		case 'total_experience':
		  return $item[ $column_name ];
		default:
		  return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
	  }
	}
	public function get_hidden_columns()
	{
			// Setup Hidden columns and return them
			return array();
	}
	
	/** 
	* Columns to make sortable. 
	* * @return array 
	*/
	public function get_sortable_columns()
	{
		$sortable_columns = array(
			'name' => array('name',true) ,
			'expected_salary' => array('expected_salary',false) ,
			'total_experience' => array('total_experience',false) ,
		);
		return $sortable_columns;
	}
 
     /** 
	* Render the bulk edit checkbox 
	* * @param array $item 
	* * @return string 
	*/
	function column_cb($item)
	{
		return sprintf('<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['id']);
	}
	 
	/** 
	* Render the bulk edit checkbox 
	* * @param array $item 
	* * @return string 
	*/
	function column_name($item) {
		$actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&id=%s">Edit</a>',$_REQUEST['page'],'edit',$item['id']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']),
        );

	return sprintf('%1$s %2$s', $item['name'], $this->row_actions($actions) );
}
	
	/** 
* Returns an associative array containing the bulk action 
* * @return array */
public function get_bulk_actions()
{
    $actions = ['bulk-delete' => 'Delete'];
    return $actions;
}
public function process_bulk_action()
{
    // Detect when a bulk action is being triggered...
    if ('delete' === $this->current_action()) {
    // In our file that handles the request, verify the nonce.
            $nonce = esc_attr($_REQUEST['_wpnonce']);
        if (!wp_verify_nonce($nonce, 'bx_delete_records')) {
            die('Go get a life script kiddies');
            }
        else {
            self::delete_records(absint($_GET['record']));
            $redirect = admin_url('admin.php?page=codingbin_records');
            wp_redirect($redirect);
            exit;
        }
    }
 
    // // If the delete bulk action is triggered
     // // If the delete bulk action is triggered
		// if ((isset($_POST['action']){
			// $_POST['action'] == 'bulk-delete') || (isset($_POST['action2']) & amp; & amp;
			// $_POST['action2'] == 'bulk-delete')) {
			// $delete_ids = esc_sql($_POST['bulk-delete']);
			// // loop over the array of record IDs and delete them
			// foreach($delete_ids as $id) {
				// self::delete_records($id);
			// }
	 
			// $redirect = admin_url('admin.php?page=codingbin_records');
			// wp_redirect($redirect);
			// exit;
			// exit;
		// }
	// }
}
/** 
* Delete a record record. 
* * @param int $id customer ID 
*/
public static function delete_records($id)
{
    global $wpdb;
	$candidate_table = $wpdb->prefix.'candidate';
    $wpdb->delete($candidate_table, ['id' => $id], ['%d']);
}

	/** 
	*Text displayed when no record data is available 
	*/
	public function no_items()
	{
		_e('No record found in the database.', 'bx');
	}

	/** 
	* Returns the count of records in the database. 
	* * @return null|string 
	*/
	public static function record_count()
	{
		global $wpdb;
		$candidate_table = $wpdb->prefix.'candidate';
		$sql = "SELECT COUNT(*) FROM $candidate_table";
		return $wpdb->get_var($sql);
	}
}//class

function o_add_menu_items(){
    add_menu_page('Plugin List Table', 'Candidate List', 'activate_plugins', 'candidates', 'candidate_list_page');
} 
add_action('admin_menu', 'o_add_menu_items');

function candidate_list_page() {
static $myListTable;
    if( ! isset($myListTable)) {
        require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
        require_once(ABSPATH . 'wp-admin/includes/screen.php');
        require_once(ABSPATH . 'wp-admin/includes/class-wp-screen.php');
        require_once(ABSPATH . 'wp-admin/includes/template.php');
        $myListTable = new Basecareer_candidate_list();
    }

    echo '</pre><div class="wrap"><h2>My List Table Test</h2>';
    $myListTable->prepare_items();

	?>
	<form method="post">
		<input type="hidden" name="page" value="candidate_list_page">
	<?php

		$myListTable->search_box('search', 'search_id');
		$myListTable->display();

		echo '</form></div>';
}