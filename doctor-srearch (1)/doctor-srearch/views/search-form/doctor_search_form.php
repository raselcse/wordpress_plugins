
<div class="doctor_search_form_section">
	
	<p class="title"><?php echo esc_attr( get_option('ds_sub_title') ); ?></p>
	
	<!-- http://67.225.137.209/index.php/home_api/search/format/json-->
	<form action="https://doctorola.com/frontend_final/home/search_result" method="post" target="_blank"accept-charset="utf-8" class="form-horizontal" id="desktop_mobile">
			<div class="form-group">
				<select name="specialty" class="specialty form-control input-sm" id="sp_mobile" style="border-top-left-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(238, 238, 238);">
					<option value="">Select Specialty</option>
					<option value="11">Gynaecologic Oncology (Cancer of Female Reproductive System)</option>
					<option value="48">Gynaecology and Obstetrics (Pregnancy, Menstrual, Uterus, Female)</option>
					<option value="47">Paediatric Surgery (Surgery for Children)</option>
					<option value="25">Paediatrics (Child or Infant any disease)</option>
					<?php
					foreach($specialities as $speciality) {
						echo "<option value='".$speciality[id]."'>".$speciality[title]."</option>";
					}	
					?>  
				</select>
			</div>
			<div class="loader-image" style="display:none;">
				<?php
					echo '<img src="' . plugins_url( '../public/image/loading.gif', dirname(__FILE__) ) . '" > ';
	
				?>
			</div>
		  <div class="form-group">
		    
			<select name="city" class="city_home form-control city_autocomplete_mobile input-sm" id="city_list" style="background-color: rgb(238, 238, 238);">
			<option value="">Select City</option>
			<?php
				foreach($cities as $city) {
					//var_dump($city[id]);
					echo "<option value='".$city[id]."'>".$city[title]."</option>";
				}	
			?>
			</select>
			
		  </div>
		  <div class="form-group">
			   <select class="form-control area area_mob input-sm" id="area_mobile" name="area"><option value="0" selected="" hidden="">Area</option><option value="0">Any</option>
			 
				</select>
		  </div>
		  
		  <div class="form-group">
			<select class="form-control gender input-sm" id="gender_mobile" name="gender">
				<option value="a" selected="" hidden="">Gender</option>
				<option value="a">Any</option>
				<option value="m">Male Doctors only</option>
				<option value="f">Female Doctors only</option>
			</select>
			
		    <input type="hidden" name="search_date" value="<?php echo date("Y-d-m", strtotime('tomorrow'));?>">
		    <input type="hidden" name="choice" value="area">
		    <input type="hidden" name="area" value="0">
		    <input type="hidden" id="sp_field" name="sp_field" value="">
		    <input type="hidden" id="city_autocomplete" name="city_autocomplete" value="">
			<input type="hidden" name="city_name" id="city_name" value="">
			<input type="hidden" name="city_suggestion_name" id="city_suggestion_name">
			<input type="hidden" name="city_suggestion_id" id="city_suggestion_id">
			<input type="hidden" name="type_suggestion_id" id="type_suggestion_id" value="1">
			<input type="hidden" name="type_suggestion_name" id="type_suggestion_name" value="Doctor">
		    
		  </div>
		  
		<button type="submit" class="btn btn-primary" style="background-color:<?php echo esc_attr( get_option('ds_button_background_color') ); ?>; color: <?php echo esc_attr( get_option('ds_button_text_color') ); ?>"><?php echo esc_attr( get_option('ds_button_text') ); ?></button>
	</form>
</div>

<script>
	jQuery(document).ready(function( $ ) {
		 var currentDate = new Date();
		var tomorrow = currentDate.setDate(currentDate.getDate() + 1);
		console.log(tomorrow);
		$( "select#sp_mobile" ).change(function() {
		    var value_of_speciality_id = $(this).val();
			
			var sp_name = $("#sp_mobile option[value="+value_of_speciality_id+"]").text();
			sp_name = sp_name.replace(/\(|\,+/g, "");
			sp_name = sp_name.replace(/\)|\,+/g, "");
			sp_name = sp_name.replace(/\s|\,+/g, "-");
			
			
			$("#sp_field").val(sp_name);
			});
		$( "select#city_list" ).change(function() {
			var value_of_city_id = $(this).val();
			$("#city_autocomplete").val($("#city_list option[value="+value_of_city_id+"]").text());
			$("#city_name").val($("#city_list option[value="+value_of_city_id+"]").text());
			$("#city_suggestion_name").val($("#city_list option[value="+value_of_city_id+"]").text());
			$("#city_suggestion_id").val(value_of_city_id);
			
		    $(".loader-image").show();
			var url = "http://67.225.137.209/index.php/api/area/city_id/"+value_of_city_id+"/username/faebaa29de34448911476aef843e8666/password/a22f7fa8957fe4d5a75c5f985431d30c/format/json";
			//obj = $.parseJSON(url);
			
			$("select#area_mobile").empty();
			$("select#area_mobile").append('<option value="0">Any</option>');
			$.getJSON(url, function(data){
				for (var i = 0, len = data.length; i < len; i++) {
					console.log(data[i].id);
					$("select#area_mobile").append('<option value="'+data[i].id+'">'+data[i].title+'</option>');
					$(".loader-image").hide();
				}
			});
		
		});
	});
			   
</script>