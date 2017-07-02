
       <style type="text/css">

       </style>
        <div id="prescription-section">   
			<h1>Edit Lab Test</h1>
            <?php if(isset($success_msg)){
					echo '<h3 style="color:green">'.$success_msg ."</h3>";

				}
				else{
					echo '<h3 style="color:red">'.$error_msg."</h3>";
				}
				if(isset($allprescription)){
					foreach( $allprescription as $prescription ) {
						$id = $prescription->id;
						$user_name = $prescription->user_name;
						$user_email = $prescription->user_email;
						$user_phone = $prescription->user_phone;
						$prescription_title = $prescription->prescription_title;
						$prescription_description = $prescription->prescription_description;
						$prescription_media_id = $prescription->prescription_media_id;
						$prescription_order_status = $prescription->prescription_order_status;
						
						
					}
					?>
			<form enctype="application/x-www-form-urlencoded" action="admin.php?page=updatePrescription" method="post">
				
		</div>

        <h3>Lab Test Information </h3>
	
        <table class="widefat" style="margin-top: .5em;">
			<tbody>
			    <tr>
					<th width="15%">Name:</th>
					<td>
					<?php echo $user_name; ?>
					</td>
				</tr>
				<tr>
					<th width="15%">Email:</th>
					<td>
					<?php echo $user_email; ?>
					</td>
				</tr>
				<tr>
					<th width="15%">Phone/Mobile:</th>
					<td>
					<?php echo $user_phone; ?>
					</td>
				</tr>
				<tr>
					<th width="15%">Test Name </th>
					<td colspan="2">
					  <?php echo $prescription_title; ?>
					</td>
				</tr>
			  
				<tr>
					<th width="15%" valign="top">Test Description</th>
					<td>
						<?php echo $prescription_description; ?>
					</td>
					
				</tr>
				
				<tr>
					 <th width="15%" valign="top">Prescription View</th>
					<td>
						<?php
						prescription_file_thumbnail_view($prescription_media_id);	
						?>
				        
						 
					</td>
					
				</tr>
				
				<tr>
					 <th width="15%" valign="top">Test Description</th>
					<td>
						<input id="prescriptionId" name="id" type="hidden" value="<?php echo $id; ?>">
						<select id="prescription_order_status" name="prescription_order_status">
							
							<?php 
							 $selected0 = ( $prescription_order_status ==  'pending') ? 'selected' : ''; 
							 $selected1 = ( $prescription_order_status ==  'processing') ? 'selected' : ''; 
							 $selected2 = ( $prescription_order_status ==  'on-hold') ? 'selected' : ''; 
							 $selected3 = ( $prescription_order_status ==  'completed') ? 'selected' : ''; 
							 $selected4 = ( $prescription_order_status ==  'cancelled') ? 'selected' : ''; 
							 $selected5 = ( $prescription_order_status ==  'refunded') ? 'selected' : ''; 
							?>
							
							<option value="pending" <?php echo $selected0 ?> >Pending</option>
							<option value="processing" <?php echo $selected1 ?> >Processing</option>
							<option value="on-hold"    <?php  echo $selected2 ?> >On hold</option>
							<option value="completed"   <?php  echo $selected3 ?> >Completed</option>
							<option value="cancelled"   <?php echo $selected4 ?> >Cancelled</option>
							<option value="refunded"   <?php echo $selected5 ?> >Refunded</option>
						</select>
				
					</td>
					
				</tr>
				

			</tbody>
		</table>
        

         

      <div>
      <input class="button-primary" type="submit" value="Update"> <a href="admin.php?page=lab_test" class="button">Cancel</a>
      </div>
	</form>
	<?php
	}
	?>  