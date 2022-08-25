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
              
				?>

        </div>
		<form enctype="application/x-www-form-urlencoded" action="admin.php?page=saveAdvertisement" method="post">
			<table class="widefat" style="margin-top: .5em;">
				<tbody>
			      	<tr>
				        <th width="15%">Title</th>
				        <td colspan="2">
				        	<input id="AdvertiseAdName" name="ad_name" type="text" value="" style="width: 300px;">
				        </td>
			      	</tr>
			      
			      	
				  	<tr>
				        <th valign="top">Banner Images</th>
						<td colspan="2">
							<input id="AdvertiseImage" name="image" type="text" style="width: 500px;">
						</td>
					</tr>

						<tr>
				         <th width="15%" valign="top">Advertisment Link</th>
				        <td>
				        	<input id="AdvertiseImage" name="link" type="text" style="width: 500px;">
				        </td>
			 	        
			     	</tr>

					<tr>
				        <th width="15%" valign="top">Advertisment Type</th>
				        <td colspan="2">
				        	<select id="Advertise_AdvertiseType_select" name="AdvertiseType_id" style="width: 200px">
								<?php
								  // Add custom option as default

								  // Get All Type as array
								  foreach ( $types as $type )  :

									// Check if current term ID is equal to term ID stored in 

									echo '<option value="' . $type->id . '">' . $type->title . '</option>';

								  endforeach;
								?>
							</select>
				        </td>
			      	</tr>
					<tr>
				        <th>Category</th>
				        <td colspan="2">
					        <?php
							echo '<select name="categories">';
								  // Add custom option as default
								  echo '<option>' . __('No Category', 'text-domain') . '</option>';

								  // Get categories as array
								  $categories = get_categories( $args );
								  foreach ( $categories as $category ) :

									// Check if current term ID is equal to term ID stored in 

									echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';

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
						<option value="1">Date Wise</option>
						<option value="2">According to View </option>
						<option value="3">According to click </option>
					</select>
			    
				<tr class="date">
			    <th width="15%">Start date (day/month/year)</th>
			    <td>
			    	<input id="AdvertiseStartDate" name="start_date" type="date" value="" style="width: 300px;">
			    </td>
			    <th width="15%">End date (day/month/year)</th>
			    <td>
			    	<input id="AdvertiseEndDate" name="end_date" type="date" value="" style="width: 300px;">
					</div>
				</td>
				</tr>	

			<tr class="max-view hide-section">
			    <th width="15%" >Maximum View</th>
				<td><input id="AdvertiseMaxView" name="max_view" type="text" value="" style="width: 300px;"><em>Leave empty or 0 to skip this.</em></td>
			    	
			</tr>
			<tr class="max-click hide-section">
					<th width="15%">Maximum Clicks</th>
				<td><input id="AdvertiseMaxClick" name="max_click" type="text" value="" style="width: 300px;"><em>Leave empty or 0 to skip this.</em></td>
						
			</tr>

			</tbody>					
			</table>
			<h3> Advanced</h3>
			<table class="widefat" style="margin-top: .5em">

			<tbody>

				<tr>
			    <th width="15%" valign="top">Device</th>
			    <td>
			    	<label for="adrotate_desktop"><center><input type="checkbox" name="opl_ad_desktop" value="Y" checked="1"><br>Computers</center></label>
			    </td>
			    <td>
			    	<label for="adrotate_mobile"><center><input type="checkbox" name="opl_ad_mobile" value="Y" checked="1"><br>Mobile</center></label>
			    </td>
			    <td>
			    	<label for="adrotate_tablet"><center><input type="checkbox" name="opl_ad_tablet" value="Y" checked="1"><br>Tablets</center></label>
			    </td>
			    <td colspan="2" rowspan="2">
			    	<em>Also enable mobile support in the group this advert goes in or these are ignored.<br>Operating system detection only detects iOS/Android/Others or neither. Only works if Smartphones and/or Tablets is enabled.</em>
			    </td>
			</tr>
				<tr>
			    <th width="15%" valign="top">Mobile OS</th>
			    <td>
			    	<label for="adrotate_ios"><center><input type="checkbox" name="opl_ad_ios" value="Y" checked="1"><br>iOS</center></label>
			    </td>
			    <td>
			    	<label for="adrotate_android"><center><input type="checkbox" name="opl_ad_android" value="Y" checked="1"><br>Android</center></label>
			    </td>
			    <td>
			    	<label for="adrotate_other"><center><input  type="checkbox" name="opl_ad_other" value="Y" checked="1"><br>Others</center></label>
			    </td>
			</tr>
			</tbody>
			</table>

			<input class="button button-primary" type="submit" value="Add">
			<a href="admin.php?page=advertisement" class="button">Cancel</a>
    	</form>

      
        