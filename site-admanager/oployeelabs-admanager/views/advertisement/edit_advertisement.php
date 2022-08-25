
       <style type="text/css">

       </style>
        <div id="opl-advertisement">   
			<h1>Add New Advertisement Type</h1>
            <?php if(isset($success_msg)){
					echo '<h3 style="color:green">'.$success_msg ."</h3>";

				}
				else{
					echo '<h3 style="color:red">'.$error_msg."</h3>";
				}
				if(isset($types)){
					foreach( $types as $type ) {
						$id = $type->id;
						$ad_name = $type->ad_name;
						$image = $type->image;
						$link = $type->link;
						$advertise_type_id = $type->advertise_type_id;
						$categories_id = $type->categories;
						$schedule_type = $type->schedule_type;
						$start_date = $type->start_date;
						$end_date = $type->end_date;
						$max_click = $type->max_click;
						$max_view = $type->max_view;
						$computer = $type->computer;
						$mobile = $type->mobile;
						$tablet = $type->tablet;
						$ios_mobile = $type->ios_mobile;
						$android_mobile = $type->android_mobile;
						$others_mobile = $type->others_mobile;
					}
					?>
			<form enctype="application/x-www-form-urlencoded" action="admin.php?page=updateAdvertisement" method="post">
				
		</div>

        <h3>Basic your advertisement</h3>
        
        <table class="widefat" style="margin-top: .5em;">
		<tbody>
      	<tr>
	        <th width="15%">Title</th>
	        <td colspan="2">
	        	<input id="AdvertiseAdName" name="ad_name" type="text" value="<?php echo $ad_name; ?>" style="width: 300px;">
				<input id="advertisementId" name="id" type="hidden" value="<?php echo $id; ?>" style="width: 300px;">
	        </td>
      	</tr>
      	<tr>
	        <th valign="top">Banner src</th>
	        <td>
	        	<input id="AdvertiseImage" name="image" type="text" value="<?php echo $image; ?>" style="width: 500px;">
	        </td>
 	       
     	</tr>
      	
      	<tr>
	        <th valign="top">Banner Link</th>
			<td colspan="2">
				<input id="AdvertiseLink" name="link" type="text" value="<?php echo $link; ?>" style="width: 300px;">
			</td>
		</tr>

	  	<tr>
	        <th valign="top">Preview</th>
	        <td colspan="2">
	        	<div><a href="<?php echo $link; ?>"><img src="<?php echo $image?>"></a></div>
		        <br><em>Note: While this preview is an accurate one, it might look different then it does on the website.				<br>This is because of CSS differences. Your themes CSS file is not active here!</em>
			</td>
      	</tr>
		
		<tr>
	        <th width="15%" valign="top">Advertisement Type</th>
	        <td colspan="2">
	        	<select id="Advertise_AdvertiseType_select" name="AdvertiseType_id" style="width: 200px">
						<?php
						   // Get All Type as array
						  foreach ( $adtypes as $type )  :

							// Check if current term ID is equal to term ID stored in database
							$selected= ( $advertise_type_id ==  $type->id  ) ? 'selected' : '';

							echo '<option value="' . $type->id . '"' . $selected . '>' . $type->title . '</option>';

						  endforeach;
						?>
					</select>
	        </td>
        </tr>

        	<tr>
	        <th width="15%" valign="top">Category</th>
	        <td colspan="2">
	        	<?php
					echo '<select name="categories">';
					  // Add custom option as default
					echo '<option>' . __('No Category', 'text-domain') . '</option>';

					// Get categories as array
					$categories = get_categories( $args );
					foreach ( $categories as $category ) :
                        
						// Check if current term ID is equal to term ID stored in database
						$selected = ( $categories_id ==  $category->term_id  ) ? 'selected' : '';

						echo '<option value="' . $category->term_id . '" ' . $selected . '>' . $category->name.'</option>';

					  endforeach;

					echo '</select>';
					?>
	        </td>
        </tr>
		
		</tbody>
	</table>

         <h3>Schedule your advertisement</h3>
        <table class="widefat" style="margin-top: .5em">
		<tbody>
      	 <Label>Schedule Type </label>
        	<select id="schedule_status" name="schedule_type">
			    <?php 
			     $selected1 = ( $schedule_type ==  '1') ? 'selected' : ''; 
			     $selected2 = ( $schedule_type ==  '2') ? 'selected' : ''; 
			     $selected3 = ( $schedule_type ==  '3') ? 'selected' : ''; 
				?>
				<option value="" <?php echo $selected0 ?>> </option>
				<option value="1" <?php echo $selected1 ?>>Date Wise</option>
				<option value="2" <?php echo $selected2 ?>>According to View </option>
				<option value="3" <?php echo $selected3 ?>>According to click </option>
			</select>
	        
      	<tr <?php echo ( $schedule_type ==  '1') ? 'class="date show-section"' : 'class="date hide-section"';  ?>>
	        <th width="15%">Start date (day/month/year)</th>
	        <td>
	        	<input id="AdvertiseStartDate" name="start_date" type="date" value="<?php echo $start_date; ?>" >
	        </td>
	        <th width="15%">End date (day/month/year)</th>
	        <td>
	        	<input id="AdvertiseEndDate" name="end_date" type="date" value="<?php echo $end_date; ?>">
			</td>
      	</tr>	

		<tr <?php echo ( $schedule_type ==  '2') ? 'class="max-view show-section"' : 'class="max-view hide-section"';  ?>>
	        <th width="15%" >Maximum View</th>
        	<td><input id="AdvertiseMaxView" name="max_view" type="text" value="<?php echo $max_view; ?>"> <em>Leave empty or 0 to skip this.</em></td>
		    	
		</tr>
		<tr <?php echo ( $schedule_type ==  '3') ? 'class="max-click show-section"' : 'class="max-click hide-section"';  ?>>
	   		<th width="15%">Maximum Clicks</th>
        	<td><input id="AdvertiseMaxClick" name="max_click" type="text" value="<?php echo $max_click; ?>"><em>Leave empty or 0 to skip this.</em></td>
      			
		</tr>
	
		</tbody>					
	</table>
     
      <h3> Advanced</h3>
    <table class="widefat" style="margin-top: .5em">

		<tbody>
       
     	<tr>
	        <th width="15%" valign="top">Device</th>
	        <td>
	        	<label for="opl_ad_desktop"><center><input type="checkbox" name="opl_ad_desktop" value="Y" <?php echo $checked = ( $computer ==  'Y') ? 'checked' : ''; ?>><br>Computers</center></label>
	        </td>
	        <td>
	        	<label for="opl_ad_mobile"><center><input type="checkbox" name="opl_ad_mobile" value="Y" <?php echo $checked = ( $mobile ==  'Y') ? 'checked' : ''; ?> ><br>Mobile</center></label>
	        </td>
	        <td>
	        	<label for="opl_ad_tablet"><center><input type="checkbox" name="opl_ad_tablet" value="Y" <?php echo $checked = ( $tablet ==  'Y') ? 'checked' : ''; ?>><br>Tablets</center></label>
	        </td>
	        <td colspan="2" rowspan="2">
	        	<em>Also enable mobile support in the group this advert goes in or these are ignored.<br>Operating system detection only detects iOS/Android/Others or neither. Only works if Smartphones and/or Tablets is enabled.</em>
	        </td>
		</tr>
     	<tr>
	        <th width="15%" valign="top">Mobile OS</th>
	        <td>
	        	<label for="opl_ad_ios"><center><input type="checkbox" name="opl_ad_ios" value="Y" <?php echo $checked = ( $ios_mobile ==  'Y') ? 'checked' : ''; ?>><br>iOS</center></label>
	        </td>
	        <td>
	        	<label for="opl_ad_android"><center><input type="checkbox" name="opl_ad_android" value="Y" <?php echo $checked = ( $android_mobile ==  'Y') ? 'checked' : ''; ?>><br>Android</center></label>
	        </td>
	        <td>
	        	<label for="opl_ad_other"><center><input  type="checkbox" name="opl_ad_other" value="Y" <?php echo $checked = ( $others_mobile ==  'Y') ? 'checked' : ''; ?>><br>Others</center></label>
	        </td>
		</tr>
		</tbody>
	</table>   

      <div>
      	<input class="button-primary" type="submit" value="Update"> <a href="admin.php?page=advertisement" class="button">Cancel</a>
      </div>
	</form>
	<?php
	}
	?>  