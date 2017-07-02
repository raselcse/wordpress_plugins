       <style type="text/css">

       </style>
        <div id="opl-advertisement">   
			<h1>Add New Lab Test Discount</h1>
          <?php if(isset($success_msg)){
					echo '<h3 style="color:green">'.$success_msg ."</h3>";
					echo '<a href="admin.php?page=add_lab_discount" class="button button-primary"> Add New Discount</a>';
				}
				else{
					echo '<h3 style="color:red">'.$error_msg."</h3>";
					echo '<a href="admin.php?page=add_lab_discount" class="button button-primary"> Add New Discount</a>';
				}
              
				?>

        </div>
		<form enctype="application/x-www-form-urlencoded" action="admin.php?page=saveLabDiscount" method="post">
			<table class="widefat" style="margin-top: .5em;">
				<tbody>
			      	<tr>
				        <th width="15%">Test Discount Name </th>
				        <td colspan="2">
				        	<input id="AdvertiseAdName" name="discount_name" type="text" value="" style="width: 300px;">
				        </td>
			      	</tr>
			        <tr>
				        <th width="15%" valign="top">Diagnostic Center Name</th>
				        <td colspan="2">
				        	<select id="Advertise_AdvertiseType_select" name="dc_id" style="width: 200px">
								<?php
								  
								  foreach ( $diagnostic_centeres as $diagnostic_center )  :

									// Check if current term ID is equal to term ID stored in 

									echo '<option value="' . $diagnostic_center->id . '">' . $diagnostic_center->dc_name . '</option>';
                                    
								  endforeach;
								?>
							</select>
				        </td>
			      	</tr>
					
					<tr>
				        <th width="15%" valign="top">Lab Test Name</th>
				        <td colspan="2">
				        	<select id="Advertise_AdvertiseType_select" name="lab_test_id" style="width: 200px">
								<?php
								  
								  foreach ( $alltest as $test )  :

									// Check if current term ID is equal to term ID stored in 

									echo '<option value="' . $test->id . '">' . $test->lab_test_name . '</option>';

								  endforeach;
								?>
							</select>
				        </td>
			      	</tr>
					
					<tr>
				        <th width="15%">Lab Test Price </th>
				        <td colspan="2">
				        	<input id="AdvertiseAdName" name="test_price" type="text" value="" style="width: 300px;">
				        </td>
			      	</tr>
			      	
					<tr>
				        <th width="15%">Discount Price </th>
				        <td colspan="2" width="35%">
				        	<input id="AdvertiseAdName" name="discount_amount" type="text" value="" style="width: 300px;">
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
				        	<textarea rows="3" cols="19" id="AdvertiseImage" name="discount_description" style="width: 500px;">
							
							</textarea>
				        </td>
			 	        
			     	</tr>
	
				</tbody>
			</table>
			<input class="button button-primary" type="submit" value="Add">
			<a href="admin.php?page=lab_test" class="button">Cancel</a>
    	</form>
        
      
        