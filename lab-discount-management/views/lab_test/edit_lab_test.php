
       <style type="text/css">

       </style>
        <div id="opl-advertisement">   
			<h1>Edit Lab Test</h1>
            <?php if(isset($success_msg)){
					echo '<h3 style="color:green">'.$success_msg ."</h3>";

				}
				else{
					echo '<h3 style="color:red">'.$error_msg."</h3>";
				}
				if(isset($alltest)){
					foreach( $alltest as $test ) {
						$id = $test->id;
						$lab_test_name = $test->lab_test_name;
						$lab_test_description = $test->lab_test_description;
						
					}
					?>
			<form enctype="application/x-www-form-urlencoded" action="admin.php?page=updateLabTest" method="post">
				
		</div>

        <h3>Lab Test Information </h3>
        <table class="widefat" style="margin-top: .5em;">
			<tbody>
				<tr>
					<th width="15%">Test Name </th>
					<td colspan="2">
					    <input type="hidden" name="id" required value ="<?php echo $id; ?>" autocomplete="off" />
						<input name="lab_test_name" type="text" value="<?php echo $lab_test_name; ?>" style="width: 300px;">
					</td>
				</tr>
			  
				<tr>
					 <th width="15%" valign="top">Test Description</th>
					<td>
						<textarea name="lab_test_description" style="width: 500px;">
							<?php echo $lab_test_description; ?>
						</textarea>
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