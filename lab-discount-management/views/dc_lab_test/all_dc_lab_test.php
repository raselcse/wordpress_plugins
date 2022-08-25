   

    <div id="opl-advertisement">
		    <div>
				<a href="admin.php?page=lab_test" class="button button-primary"> All Test</a>
				<a href="admin.php?page=diagnostic_center" class="button button-primary"> All Diagnostic Center</a>
				<a href="admin.php?page=allLabDiscount" class="button button-primary"> All Discount</a>
			</div>
			<h2> All Lab Test Discount list </h2>
			<a href="admin.php?page=add_lab_discount" class="button button-primary"> Add New Discount</a>
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
					  <th scope="col">Discount title</th>
					  <th scope="col">Diagnostic Center Name</th>
					  <th scope="col">lab Test Name</th>
					  <th scope="col">Test Price</th>
					  <th scope="col">Coupon</th>
					  <th scope="col">Discount Price</th>
					  <th scope="col">Description</th>
					 <th scope="col" colspan="2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$html = null;
					$sl_no = 0;
					foreach( $alldiscount as $discount ) {
					    $sl_no =$sl_no+1; 
						$dc_id = $discount->dc_id;
						$lab_test_id = $discount->lab_test_id;
						$load              = new Load();
						$labDiscountModel         = $load->model('model_dc_lab_test');
						$diagnostic_center_name['dcnames'] = $labDiscountModel->getFieldName('diagnostic_center','dc_name', $dc_id);
						$lab_test_name['labtestnames'] = $labDiscountModel->getFieldName('lab_test','lab_test_name', $lab_test_id);
						//var_dump($diagnostic_center_name['dcnames'][0]->dc_name);
						//var_dump($lab_test_name['labtestnames'][0]->lab_test_name);
						
					    $html .= "<tr>
						  <td> $sl_no </td>
						  <td> $discount->discount_name </td>
						  <td> ".$diagnostic_center_name['dcnames'][0]->dc_name."</td>
						  <td> ".$lab_test_name['labtestnames'][0]->lab_test_name."</td>
						  <td> $discount->test_price</td>
						  <td> $discount->discount_coupon</td>
						  <td> $discount->discount_amount</td>
						  <td> $discount->discount_description</td>
						  <td> <a href='admin.php?page=getLabDiscountById&id=$discount->id'>Edit</a> </td>
						  <td> <a href='admin.php?page=deleteLabDiscount&id=$discount->id'>Delete</a> </td>
						</tr>";
					}
					echo  $html;
					?>

				</tbody>
                <thead>
					<tr>
						<th scope="col">Sl No.</th>
						<th scope="col">Discount title</th>
						<th scope="col">Diagnostic Center Name</th>
						<th scope="col">lab Test Name</th>
						<th scope="col">Discount Price</th>
						<th scope="col">Coupon</th>
						<th scope="col">Discount amount</th>
						<th scope="col">Description</th>
						<th scope="col" colspan="2">Action</th>
					</tr>
				</thead>
			</table>



		
		</div>