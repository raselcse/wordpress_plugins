    <?php 
  
		$lab_test_id = $_GET['lab_test_id'];
		$sort = $_GET['sort'];
		global $wpdb;
		$customPagHTML     = "";
		$table_name = $wpdb->prefix .'dc_lab_test';
		if($lab_test_id){
		$query             = "SELECT * FROM $table_name WHERE lab_test_id = $lab_test_id";
		}
		else{
		$query             = "SELECT * FROM $table_name";	
		}
		$total_query     = "SELECT COUNT(1) FROM ($query) AS combined_table";
		$total             = $wpdb->get_var( $total_query );
		$items_per_page = 12;
		$page             = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
		$offset         = ( $page * $items_per_page ) - $items_per_page;
		if($sort == 'high'){
			$result         = $wpdb->get_results( $query . " ORDER BY discount_amount DESC LIMIT ${offset}, ${items_per_page}" );
		}
		else{
			$result         = $wpdb->get_results( $query . " ORDER BY discount_amount ASC LIMIT ${offset}, ${items_per_page}" );

		}
		$totalPage         = ceil($total / $items_per_page);
		if($totalPage > 1){
		$customPagHTML     =  '<div><span>Page '.$page.' of '.$totalPage.'</span>'.paginate_links( array(
		'base' => add_query_arg( 'cpage', '%#%' ),
		'format' => '',
		'prev_text' => __('&laquo;'),
		'next_text' => __('&raquo;'),
		'total' => $totalPage,
		'current' => $page
		)).'</div>';
		}


	?>
			
    <div id="lab_test_dicount_list">
		<div class='col-md-8'>
			<h2 class='discount_title'> For <?php  echo $labTestName; ?> Lab Test Discount list </h2>
		</div>
		<?php if($alldiscount){
			if($_SERVER['QUERY_STRING']){
			?>
			
			<div class='sorting_list first col-md-4'>Sort by <a class="button high-price button-primary" href="?<?php echo $_SERVER['QUERY_STRING']?>&sort=high"> High Price </a> <a href="?<?php echo $_SERVER['QUERY_STRING']?>&sort=low" class="button low-price button-primary">Low Price</a></div>
			<?php } 
			else{?>
			<div class='sorting_list second col-md-4'>Sort by <a class="button button-primary" href="?sort=high"> High Price </a> <a href="?sort=low" class="button button-primary">Low Price</a></div>	
			<?php
			}
			?>
			<ul class="discount_list">
			
				<?php
				$html = null;
				$sl_no = 0;
				
				foreach( $result as $discount ) {
					$sl_no =$sl_no+1; 
					
					$dc_id = $discount->dc_id;
					$lab_test_id = $discount->lab_test_id;
					$load              = new Load();
					$labDiscountModel         = $load->model('model_dc_lab_test');
					$diagnostic_center_name['dcnames'] = $labDiscountModel->getFieldName('diagnostic_center','dc_name', $dc_id);
					$lab_test_name['labtestnames'] = $labDiscountModel->getFieldName('lab_test','lab_test_name', $lab_test_id);
					$offer = number_format((($discount->test_price-$discount->discount_amount)/($discount->test_price))*100, 0, '.', '');
					
					
					//var_dump($diagnostic_center_name['dcnames'][0]->dc_name);
					//var_dump($lab_test_name['labtestnames'][0]->lab_test_name);
					$html .= "<li class='col-sm-4'>
					  <div class=' row inner_discount_list'>
					  <h2 class='col-md-12'>$discount->discount_name</h2>
					  <div class='dc_name col-md-12'>".$diagnostic_center_name['dcnames'][0]->dc_name." </div>
					  <div class='lab_test_name col-md-12'> ".$lab_test_name['labtestnames'][0]->lab_test_name."</div>
					  
					  <div class='priceing col-md-6'><span class='main_price'>Tk $discount->test_price </span> <span class='discount_price'>Tk $discount->discount_amount</span> </div>
					  <div class='offer_text col-md-4'> $offer% OFF</div>
					  
					  <div class='discount_coupon_number col-md-12'>Discount Code: <span>$discount->discount_coupon</span></div>
					  
					  </div>
					</li>";
				}
				echo  $html;
				
				?>

			
		   
		</ul>
		<div class='pagination col-md-12'><?php echo $customPagHTML;?></div>
		<?php }
				else{
					$html = 'Your test discount has not found';
					echo $html;
				}
		
		?>
		
		</div>