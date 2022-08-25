       <style type="text/css">

       </style>
        <div id="opl-advertisement">   
			<h1>Add New Diagnostic</h1>
          <?php if(isset($success_msg)){
					echo '<h3 style="color:green">'.$success_msg ."</h3>";
				}
				else{
					echo '<h3 style="color:red">'.$error_msg."</h3>";
				}
              
				?>

        </div>
		<form enctype="application/x-www-form-urlencoded" action="admin.php?page=save_new_diagnostic_center" method="post">
			<table class="widefat" style="margin-top: .5em;">
				<tbody>
			      	<tr>
				        <th width="15%">Diagnostic Center Name </th>
				        <td colspan="2">
				        	<input id="AdvertiseAdName" name="dc_name" type="text" value="" style="width: 300px;">
				        </td>
			      	</tr>
			      
			      	<tr>
				         <th width="15%" valign="top">Diagnostic Center Address</th>
				        <td>
				        	<textarea name="dc_address" style="width: 500px;">
							
							</textarea>
				        </td>
			 	        
			     	</tr>
					
					<tr>
				         <th width="15%" valign="top">Test Description</th>
				        <td>
				        	<textarea name="dc_description" style="width: 500px;">
							
							</textarea>
				        </td>
			 	        
			     	</tr>
					
					
	
				</tbody>
			</table>
			<input class="button button-primary" type="submit" value="Add">
			<a href="admin.php?page=diagnostic_center" class="button">Cancel</a>
    	</form>

      
        