   

    <div id="opl-advertisement">
		
			<h2> All Advertisement list </h2>
			<a href="admin.php?page=add_advertisement" class="button button-primary"> Add New Advertisement</a>
			 <?php 
				if(isset($success_msg)){
					echo '<h3 style="color:green">'.$success_msg ."</h3>";
				}
				else{
					echo '<h3 style="color:red">'.$error_msg."</h3>";
				}
			?>

			<table>
				<thead>
					<tr>
					  <th scope="col">Sl No.</th>
					  <th scope="col">Title</th>
					  <th scope="col">type</th>
					  <th scope="col">Image</th>
					  <th scope="col">Category</th>
					  <th scope="col">Link</th>
					  <th scope="col">Start Date/ End Date</th>
					  <th scope="col">View</th>
					  <th scope="col">Click</th>
					  <th scope="col" colspan="2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$html = null;
					$sl_no = 0;
					foreach( $types as $type ) {
					    $sl_no =$sl_no+1; 
					    $start_date = $type->start_date;
					    $date = date_create( $start_date);
					    $start_date_new = date_format($date, 'jS F Y');

					    $end_date = $type->end_date;
					    $create_end_date = date_create( $end_date);
					    $end_date_new = date_format($create_end_date, 'jS F Y');
					    $cat_name = get_the_category_by_ID($type->categories);

						$html .= "<tr>
						  <td> $sl_no </td>
						  <td> $type->ad_name </td>
						  <td> $type->advertise_type_id </td>
						  <td> <img width='120px' src='$type->image'/> </td>
						  <td> $cat_name </td>
						  <td> $type->link </td>
						  <td> <span style='color:green'>$start_date_new</span>  To <span style='color:red'>$end_date_new</span></td>
						  <td> $type->view_count </td>
						  <td> $type->click_count </td>
						  <td> <a href='admin.php?page=getAdvertisementById&id=$type->id'>Edit</a> </td>
						  <td> <a href='admin.php?page=deleteAdvertisement&id=$type->id'>Delete</a> </td>
						</tr>";
					}
					echo  $html;
					?>

				</tbody>
                <thead>
					<tr>
					 <th scope="col">Sl No.</th>
					  <th scope="col">Title</th>
					  <th scope="col">type</th>
					  <th scope="col">Image</th>
					  <th scope="col">Category</th>
					  <th scope="col">Link</th>
					  <th scope="col">Start Date/ End Date</th>
					  <th scope="col">View</th>
					  <th scope="col">Click</th>
					  <th scope="col" colspan="2">Action</th>
					</tr>
				</thead>
			</table>



		
		</div>