       <style type="text/css">

       </style>
        <div id="opl-advertisement">   
			<h1>Add New Lab Test</h1>
          <?php if(isset($success_msg)){
					echo '<h3 style="color:green">'.$success_msg ."</h3>";
					echo '<a href="admin.php?page=add_LabTest" class="button button-primary"> Add New Test</a>';
				}
				else{
					echo '<h3 style="color:red">'.$error_msg."</h3>";
					echo '<a href="admin.php?page=add_LabTest" class="button button-primary"> Add New Test</a>';
				}
              
				?>

        </div>
		<form enctype="application/x-www-form-urlencoded" action="admin.php?page=saveLabTest" method="post">
			<table class="widefat" style="margin-top: .5em;">
				<tbody>
			      	<tr>
				        <th width="15%">Test Name </th>
				        <td colspan="2">
				        	<input id="AdvertiseAdName" name="lab_test_name" type="text" value="" style="width: 300px;">
				        </td>
			      	</tr>
			      
			      	<tr>
				         <th width="15%" valign="top">Test Description</th>
				        <td>
				        	<textarea id="AdvertiseImage" name="lab_test_description" style="width: 500px;">
							
							</textarea>
				        </td>
			 	        
			     	</tr>
	
				</tbody>
			</table>
			<input class="button button-primary" type="submit" value="Add">
			<a href="admin.php?page=lab_test" class="button">Cancel</a>
    	</form>

      
        