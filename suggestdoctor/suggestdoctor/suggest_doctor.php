<?php
/*
Plugin Name: Suggest Doctor list
Plugin URI: http://code.tutsplus.com
Description: List of Doctor for specific Specialist in area. 
Version: 0.1
Author: Rasel
 
Copyright 2014  OplyeeLabs Ltd
*/
 
 
class Suggest_Doctor extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'Suggest_Doctor',
            __( 'Doctor Block Widget', 'Suggestdoctor' ),
            array(
                'classname'   => 'Suggest_Doctor',
                'description' => __( 'A basic Block widget to see Suggest Doctor in Every Post Sidebar.', 'Suggestdoctor' )
                )
        );
       
        load_plugin_textdomain( 'Suggestdoctor', false, basename( dirname( __FILE__ ) ) . '/languages' );
       
    }
 
    /**  
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {    
         
        extract( $args );
         
        $title      = apply_filters( 'widget_title', $instance['title'] );
        
         
        echo $before_widget;
         
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
                             

        echo $after_widget;
		
		
		$cats = array();
				foreach(get_the_category($post->ID) as $c)
				{
					$cat = get_category($c);
					array_push($cats,$cat->name);
				}

				if(sizeOf($cats)>0)
				{
					$post_categories = implode(',',$cats);
				} else {
					$post_categories = "Not Assigned";
				}

				
				
				// var_dump($post_categories);
				$suggestions = json_decode(
					file_get_contents('http://192.185.79.223/~dserve/index.php/api/doctor_suggestion/sp/'.$post_categories.'/username/9791a47fef07649b1c3e70749e898153/password/2d593e25d0560b19fd84704f0bd24049/format/json')
				);
				
				//var_dump ($suggestions[0]);
					
				?>
                    <style>
					.suggest_doctor{
						width: 45%;
						float: left;
						padding: 5px;
					}
					.thumbnail  img{
						width:75%;
					}
					.doctor_info{
						text-align: left;
						color: #343434;
						font-size: 10px;

					}
					.doctor_speciality{
						display:block;
						float:left;
					}
					</style>

				<?php foreach($suggestions as $s) { 
					$doc_name = str_replace(' ','-', $s->name); ?>
					<div class="suggest_doctor_section" >								
						<a href="<?php echo "https://doctorola.com/profile/". $s->id."/".$doc_name ."/". time() ."/" . $s->loc_id ."/". $s->city_id ."/" . $s->specialty_id; ?>">
						 <div class="suggest_doctor" style="width: 48%; float: left;">

							<div class="thumbnail new_thumb">
								<img style="width:100px; height:100px;" src="<?php echo "https://doctorola.com/doc_cpanel/assets/image/".$s->image; ?>" alt="Profile pic" />
								
							</div>
							<div class="doctor_info">
							 <strong><?php echo $s->name; ?></strong>
							</div>
						</div>
						
						</a>
					</div>
				<?php } 
				
         
    }
 
  
    /**
      * Sanitize widget form values as they are saved.
      *
      * @see WP_Widget::update()
      *
      * @param array $new_instance Values just sent to be saved.
      * @param array $old_instance Previously saved values from database.
      *
      * @return array Updated safe values to be saved.
      */
    public function update( $new_instance, $old_instance ) {        
         
        $instance = $old_instance;
         
        $instance['title'] = strip_tags( $new_instance['title'] );
       
         
        return $instance;
         
    }
  
    /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
    public function form( $instance ) {    
     
        $title      = esc_attr( $instance['title'] );
        ?>
         
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
       
     
    <?php 
    }
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'Suggest_Doctor' );
});