<?php
	/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */
 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
get_header(); 

$kt_sidebar_are = kt_option( 'kt_woo_shop_sidebar_are', 'left' );
if(is_product()){
    $kt_sidebar_are = kt_option( 'kt_woo_single_sidebar_are', 'left' );
}

$sidebar_are_layout = 'sidebar-'.$kt_sidebar_are;

if( $kt_sidebar_are == "left" || $kt_sidebar_are == "right" ){
    $col_class = "main-content col-xs-12 col-sm-8 col-md-9"; 
}else{
    $col_class = "main-content col-xs-12 col-sm-12 col-md-12";
}

?>

    <?php
        /**
         * woocommerce_before_main_content hook
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * @hooked woocommerce_breadcrumb - 20
         */
       // do_action( 'woocommerce_before_main_content' );
    ?>
    <div class="row <?php //echo esc_attr( $sidebar_are_layout );?>">
        <div class="view-product-list <?php echo esc_attr( $col_class );?>">
           <h2><?php wp_title(); ?></h2>
            <?php// woocommerce_content(); ?>
        </div>
        
    </div>
 		<div class="row list-product-row">
		
			<ul class="product-list doctor_list clearfix desktop-columns-3 tablet-columns-2 mobile-columns-1 list">
		
				
    <?php
        /**
         * woocommerce_after_main_content hook
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        //do_action( 'woocommerce_after_main_content' );
		
	  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	  $args = array(
		'post_type' => 'doctor_directory',
		'posts_per_page' => 4,
		'paged' => $paged
	  );
	$loop = new WP_Query( $args );
	
	if( $loop->have_posts() ):
				
		while( $loop->have_posts() ): $loop->the_post(); global $post;
		$doctor_designation = esc_html( get_post_meta( $post->ID, 'doctor_designation', true ) );
		$doctor_fee = esc_html( get_post_meta( $post->ID, 'doctor_fee', true ) );
		$doctor_chamber_address = esc_html( get_post_meta( $post->ID, 'doctor_chamber_address', true ) );
		?>
				
				<li class="product-item col-md-4 col-sm-6 col-xs-12 post-70 product type-product status-publish has-post-thumbnail product_cat-a-z-drugs product_cat-diabetes-product product_cat-sugar-substitutes  instock shipping-taxable purchasable product-type-simple">
					<div class="product-container">
						<div class="left-block doctor_picture">
							<a href="<?php the_permalink();?>">
								<?php the_post_thumbnail(array(120, 120))?>
							</a>
								
							     
						</div>
						<div class="right-block">
							<h5 class="product-name"><a title="Flying Ninja" href="<?php the_permalink();?>"><?php the_title();?></a></h5>
							<div class="content_price">
								 <?php
							    global $post;
								$category_detail=get_the_category($post->ID, array('post_type'=>'doctor_directory'));//$post->ID
								foreach($category_detail as $cd){
								echo $cd->name;
								
								}
								?>
							</div>
							<div class="info-orther">
								<p class="availability"><span><?php echo $doctor_designation; ?></span></p>
								<p class="availability"><label>Working Hospital:</label> <span><?php echo $doctor_chamber_address; ?></span></p>
								<p class="availability"><label>Chamber: </label><span><?php echo $doctor_chamber_address; ?></span></p>
								<div class="product-desc"><label>More Info: </label><?php the_content();?>
								</div>
							</div>
							<div class="">
								<a rel="nofollow" href="<?php the_permalink();?>" data-quantity="1" data-product_id="70" data-product_sku="" class="button product_type_simple view_details">View Details</a>
							</div> 
						</div>
					</div>
				</li>

					<?php
					endwhile;
				echo "</ul></div>";
				
					 endif;
					 
					  if (function_exists(custom_pagination)) {
						custom_pagination($loop->max_num_pages,"",$paged);
					  }
					?>

<?php get_footer();
   
	
