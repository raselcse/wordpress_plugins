
       <style type="text/css">

       </style>
        <div id="opl-advertisement">   
			<h1>Edit Diagnostic Center</h1>
            <?php if(isset($success_msg)){
					echo '<h3 style="color:green">'.$success_msg ."</h3>";

				}
				else{
					echo '<h3 style="color:red">'.$error_msg."</h3>";
				}
				if(isset($diagnostic_centeres)){
					foreach( $diagnostic_centeres as $diagnostic_center ) {
						$id = $diagnostic_center->id;
						$dc_name = $diagnostic_center->dc_name;
						$dc_address = $diagnostic_center->dc_address;
						$dc_description = $diagnostic_center->dc_description;
						
					}
					?>
			<form enctype="application/x-www-form-urlencoded" action="admin.php?page=update_diagnostic_center" method="post">
				
		</div>

        <h3>Lab Test Information </h3>
        <table class="widefat" style="margin-top: .5em;">
			<tbody>
				<tr>
					<th width="15%">Diagnostic Center Name</th>
					<td colspan="2">
					    <input type="hidden" name="id" required value ="<?php echo $id; ?>" autocomplete="off" />
						<input name="dc_name" type="text" value="<?php echo $dc_name; ?>" style="width: 300px;">
					</td>
				</tr>
			  
				<tr>
					 <th width="15%" valign="top">Address</th>
					<td>
						<textarea name="dc_address" style="width: 500px;">
							<?php echo $dc_address; ?>
						</textarea>
					</td>
					
				</tr>
				
				<tr>
					 <th width="15%" valign="top">Description</th>
					<td>
						<textarea name="dc_description" style="width: 500px;">
							<?php echo $dc_description; ?>
						</textarea>
					</td>
					
				</tr>

			</tbody>
		</table>
        

         

      <div>
      <input class="button-primary" type="submit" value="Update"> <a href="admin.php?page=diagnostic_center" class="button">Cancel</a>
      </div>
	</form>
	<?php
	}
	?>  