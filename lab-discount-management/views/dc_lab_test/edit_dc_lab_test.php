
       <style type="text/css">

       </style>
        <div id="opl-advertisement">   
			<h1>Edit Lab Discount fo Test</h1>
            <?php if(isset($success_msg)){
					echo '<h3 style="color:green">'.$success_msg ."</h3>";

				}
				else{
					echo '<h3 style="color:red">'.$error_msg."</h3>";
				}
				if(isset($alldiscount)){
					foreach( $alldiscount as $discount ) {
						$id = $discount->id;
						$discount_name = $discount->discount_name;
						$dc_id = $discount->dc_id;
						$lab_test_id = $discount->lab_test_id;
						$test_price = $discount->test_price;
						$discount_coupon = $discount->discount_coupon;
						$discount_amount = $discount->discount_amount;
						$discount_description = $discount->discount_description;
						
					}
					?>
			<form enctype="application/x-www-form-urlencoded" action="admin.php?page=updateLabDiscount" method="post">
				
		</div>

        <h3>Lab Discount Information </h3>
        <table class="widefat" style="margin-top: .5em;">
				<tbody>
			      	<tr>
				        <th width="15%">Test Discount Name </th>
				        <td colspan="2">
						
						    <input type="hidden" name="id" required value ="<?php echo $id; ?>" autocomplete="off" />
				        	<input name="discount_name" type="text" value="<?php echo $discount_name;  ?>" style="width: 300px;">
				        </td>
			      	</tr>
			        <tr>
				        <th width="15%" valign="top">Diagnostic Center Name</th>
				        <td colspan="2">
				        	<select name="dc_id" style="width: 200px">
								<?php
								  
								  foreach ( $diagnostic_centeres as $diagnostic_center )  :

									// Check if current term ID is equal to term ID stored in 
                                     $selected= ( $dc_id ==  $diagnostic_center->id  ) ? 'selected' : '';
									echo '<option value="' . $diagnostic_center->id . '"' . $selected . '>' . $diagnostic_center->dc_name . '</option>';

								  endforeach;
								?>
							</select>
				        </td>
			      	</tr>
					
					<tr>
				        <th width="15%" valign="top">Lab Test Name</th>
				        <td colspan="2">
				        	<select name="lab_test_id" style="width: 200px">
								<?php
								  
								  foreach ( $alltest as $test )  :

									// Check if current term ID is equal to term ID stored in 
                                    $selected= ( $lab_test_id ==  $test->id  ) ? 'selected' : '';
									echo '<option value="' . $test->id . '"' . $selected . '>' . $test->lab_test_name . '</option>';

								  endforeach;
								?>
							</select>
				        </td>
			      	</tr>
					
					<tr>
				        <th width="15%">Lab Test Price </th>
				        <td colspan="2">
				        	<input name="test_price" type="text" value="<?php echo $test_price;?>" style="width: 300px;">
				        </td>
			      	</tr>
			      	
					<tr>
				        <th width="15%">Discount Price </th>
				        <td colspan="2" width="35%">
				        	<input name="discount_amount" type="text" value="<?php echo $discount_amount;?>" style="width: 300px;">
				        </td>
						
						<td width="35%">
						
						
						<label style="padding-right:0px;">
							<input type="checkbox" name="set_discount" value="1" /> 
							<span><b>Set % Discount</b></span> 
                         </label>

                       <select class="percentise_discount" style="padding-left:0px;">
							<option value=""></option>
							<option value="0">0</option>
							<option value="5">5%</option>
							<option value="10">10%</option>
							<option value="15">15%</option>
							<option value="20">20%</option>
							<option value="25">25%</option>
							<option value="30">30%</option>
							<option value="35">35%</option>
							<option value="40">40%</option>
							<option value="45">45%</option>
							<option value="50">50%</option>
						</select>
						

						
						</td>
			      	</tr>
					
					<tr>
				         <th width="15%" valign="top">Discount Description</th>
				        <td>
				        	<textarea rows="3" cols="19" name="discount_description" style="width: 500px;">
							 <?php echo $discount_description;?>
							</textarea>
				        </td>
			 	        
			     	</tr>
	
				</tbody>
			</table>
        

         

      <div>
      <input class="button-primary" type="submit" value="Update"> <a href="admin.php?page=dc_lab_test" class="button">Cancel</a>
      </div>
	</form>
	<?php
	}
	?>  