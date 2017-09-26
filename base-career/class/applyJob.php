<?php	
if(!class_exists('ApplyJob')){
 
   require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
 
}
class ApplyJob extends WP_List_Table {

	function __construct(){
		global $status, $page;                

		parent::__construct( array(
			'singular'  => 'Apply Job',  
			'plural'    => 'Applied Jobs',   
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
		$apply_job_table = $wpdb->prefix.'apply_job';
		$candidate_table = $wpdb->prefix.'candidate';
		$candidate_file_table = $wpdb->prefix.'candidate_file';
		$sql = "SELECT $candidate_table.name,
						$candidate_table.id,
						$candidate_table.email,
						$candidate_table.present_salary,
						$candidate_table.phone_no,
						$candidate_table.total_experience,
						$apply_job_table.expected_salary,
						$apply_job_table.job_id,
						$apply_job_table.apply_date,
						$candidate_file_table.resume
						FROM $candidate_table
						INNER JOIN $apply_job_table ON $apply_job_table.candidate_userid = $candidate_table.candidate_userid
						INNER JOIN $candidate_file_table ON $candidate_file_table.candidate_userid = $candidate_table.candidate_userid";
	
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
			'name' => __('Name ', 'ux') , 
			'email' => __('Email', 'ux') , 
			'phone_no' => __('Phone NO', 'ux') , 
			'total_experience' => __('Total Experience', 'ux') ,
			'present_salary' => __('Present Salary', 'ux') ,  
			'expected_salary' => __('Expected Salary', 'ux') , 
			'apply_date' => __('Apply Date', 'ux') , 
			'job_id' => __('Job', 'ux') , 
			'resume' => __('Resume', 'ux') , 
		];
		return $columns;
	}
	function column_default( $item, $column_name ) {
	  switch( $column_name ) { 
		case 'name':
		case 'email':
		case 'phone_no':
		case 'total_experience':
		case 'present_salary':
		case 'expected_salary':
		case 'apply_date':
			return $item[ $column_name ];
		case 'job_id':
		    return '<a href="'.get_permalink( $item[$column_name]).'">'.get_the_title( $item[$column_name] ).'</a>';
			
			//return $item[ $column_name ];
		case 'resume':
		    return "<a class='button action' href='".site_url()."/".$item[$column_name]."'>Download</a>";
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
			'apply_date' => array('apply_date',false) ,
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
 
}
/** 
* Delete a record record. 
* * @param int $id customer ID 
*/
public static function delete_records($id)
{
    global $wpdb;
	$apply_job_table = $wpdb->prefix.'apply_job';
    $wpdb->delete($apply_job_table, ['id' => $id], ['%d']);
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
		$apply_job_table = $wpdb->prefix.'apply_job';
		$sql = "SELECT COUNT(*) FROM $apply_job_table";
		return $wpdb->get_var($sql);
	}
}//class

function applied_jobs_add_menu_items(){
    add_menu_page('Plugin List Table', 'Applied Job', 'activate_plugins', 'apply-jobs', 'apply_job_list_page');
} 
add_action('admin_menu', 'applied_jobs_add_menu_items');

function apply_job_list_page() {
static $myListTable;
    if( ! isset($myListTable)) {
        require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
        require_once(ABSPATH . 'wp-admin/includes/screen.php');
        //require_once(ABSPATH . 'wp-admin/includes/class-wp-screen.php');
        require_once(ABSPATH . 'wp-admin/includes/template.php');
        $myListTable = new ApplyJob();
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