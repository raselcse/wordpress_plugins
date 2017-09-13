<?php
	class Doctorsearch extends Ds_controller{
		
		function __construct()
		{
			parent::__construct();
		}

		public	function ds_admin_menu() {
			add_menu_page(
				__( 'Doctor search'),
				'Doctor search',
				'manage_options',
				'prescription_order',
				array( 'Doctorsearch','ds_settings_page') ,
				'',
				6
			);
		}
		
		public function doctor_search_form($msg = null){
			$load  = new Ds_load();
			$speciality_url = "http://67.225.137.209/index.php/api/specialty/username/faebaa29de34448911476aef843e8666/password/a22f7fa8957fe4d5a75c5f985431d30c/format/json";
			$speciality_content = file_get_contents($speciality_url);
		    $url = 'http://67.225.137.209/index.php/api/city/username/faebaa29de34448911476aef843e8666/password/a22f7fa8957fe4d5a75c5f985431d30c/format/json';
			$content = file_get_contents($url);
			$data['cities'] = json_decode($content, true);
			$data['specialities'] = json_decode($speciality_content, true);
			$load->view('search-form/doctor_search_form', $data);
		}
	
	
	    public function ds_settings_page() {
			?>
			<div class="wrap">
			<h1>Doctor Search setting page</h1>

			<form method="post" action="options.php">
			    <?php settings_fields( 'ds-settings-group' ); ?>
			    <?php do_settings_sections( 'ds-settings-group' ); ?>
			    <table class="form-table">
			        <tr valign="top">
			        <th scope="row">Sub Title</th>
			        <td>
						<input type="text" name="ds_sub_title" value="
						<?php 
						if(get_option('ds_sub_title')){
							echo esc_attr( get_option('ds_sub_title') );
						} 
						else{ 
							echo 'Doctor Search from Doctorola.com';
						}?>"/>
					</td>
			        </tr>
			         
			        <tr valign="top">
			        <th scope="row">Submit Button Text</th>
			        <td><input type="text" name="ds_button_text" value="
						<?php 
						if(get_option('ds_button_text')){
							echo esc_attr( get_option('ds_button_text') );
						}
						else{
							echo 'Search';
						}?>"/>
					</td>
			        </tr>
			        
			        <tr valign="top">
			        <th scope="row">Button Text Color</th>
					<td><input type="color" name="ds_button_text_color" value="
						
						<?php
						if(get_option('ds_button_text_color')){
							echo esc_attr( get_option('ds_button_text_color') );
						} 
						else{
							echo '#fff'; 
						} 
						?>"/>
					
					</td>
			        </tr>
					<tr valign="top">
			        <th scope="row">Button Background Color</th>
			        <td>
						<input type="color" name="ds_button_background_color" value="
						<?php
						if(get_option('ds_button_background_color')){
							echo esc_attr( get_option('ds_button_background_color') ); 
						} 
						else{
							echo '#dc0505';
						} ?>"/>
					</td>
			        </tr>
					<tr valign="top">
						<th>Custom Css</th>
						<td>
							<textarea style="width:100%; height:400px;"id="custom_css_textarea" name="ds_custom_css"><?php echo esc_attr( get_option('ds_custom_css') ); ?></textarea>	
						</td>
					</tr>
			    </table>
			    
			    <?php submit_button(); ?>

			</form>
			</div>
			<?php 
		} 
}