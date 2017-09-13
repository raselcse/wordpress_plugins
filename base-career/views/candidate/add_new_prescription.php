      
   
	  <style type="text/css">

       </style>
        <div id="prescription-section">   
		<?php
			//get setting info
			$notification_email_account = esc_attr( get_option('set_email_account'));
			$service_name = esc_attr( get_option('service_name'));
			
		?>
			<h2>Please send your <?php echo $service_name; ?> </h2>
        <?php
		    global $post;
			global $current_user;
			$user_id =  $current_user->ID;
			$user_name=  $current_user->user_login;
			$user_email=  $current_user->user_email;
			$user_phone=  $current_user->user_phone;
			
			
			if(isset($success_msg)){
					echo '<h3 style="color:green">'.$success_msg ."</h3>";

				}
				else{
					echo '<h3 style="color:red">'.$error_msg."</h3>";
				}
			
	  
		?>
		<form enctype="application/x-www-form-urlencoded" enctype="multipart/form-data" id="prescription_from" method="post">
			<table class="widefat" style="margin-top: .5em;">
				<tbody>
			      	<tr>
				        <th width="15%"><?php echo $service_name; ?> Title </th>
				        <td colspan="2">
				        	<input id="prescriptionTitle" name="prescription_title" type="text" value="">
				        	<input id="prescriptionUserId" name="user_id" type="hidden" value="<?php echo $user_id?>">
				        	<input id="prescriptionUserName" name="user_name" type="hidden" value="<?php echo $user_name?>">
				        	<input id="prescriptionUserEmail" name="user_email" type="hidden" value="<?php echo $user_email?>">
				        	<input id="prescriptionUserPhone" name="user_phone" type="hidden" value="<?php echo $user_phone?>">
							<input id="prescriptionNotificationEmail" name="notification_email_account" type="hidden" value="<?php echo $notification_email_account?>">
				        </td>
			      	</tr>
			      
			      	<tr>
				         <th width="15%" valign="top"><?php echo $service_name ?> Description</th>
				        <td>
				        	<textarea id="prescriptionDescription" name="prescription_description" style="width: 500px;">  </textarea>
				        </td>
			 	        
			     	</tr>
					
					<tr>
				         <th width="15%" valign="top">Upload your <?php echo $service_name ?></th>
				        <td>
				        	<input type="file" id="prescriptionFile" name="files[]"/>
				        </td>
			 	        
			     	</tr>
	
				</tbody>
			</table>
			<input class="button button-primary prescription_form_button" type="submit" value="Add">
			<a href="admin.php?page=lab_test" class="button">Cancel</a>
    	</form> 
		
						

      
        