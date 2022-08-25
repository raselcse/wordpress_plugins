<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Kute theme
 * @since KuteTheme 1.0
 */

get_header(); 
$kt_sidebar_are = kt_option( 'kt_sidebar_are', 'full' );

$sidebar_are_layout = 'sidebar-'.$kt_sidebar_are;

if( $kt_sidebar_are == "left" || $kt_sidebar_are == "right" ){
    $col_class = "main-content col-xs-12 col-sm-8 col-md-9"; 
}else{
    $col_class = "main-content col-xs-12 col-sm-12 col-md-12";
}
	$doctor_designation = esc_html( get_post_meta( $post->ID, 'doctor_designation', true ) );
	$doctor_fee = esc_html( get_post_meta( $post->ID, 'doctor_fee', true ) );
	$doctor_chamber_address = esc_html( get_post_meta( $post->ID, 'doctor_chamber_address', true ) );
?>
<div id="primary" class="content-area <?php echo esc_attr( $sidebar_are_layout );?>">
	<main id="main" class="site-main" role="main">
        <div class="container">
            <?php breadcrumb_trail();?>
            <div class="row">
                <div class="<?php echo esc_attr( $col_class );?>">
                    <?php
                    the_post();
                    ?>
                    <header>
    					<h1 class="page-title screen-reader-text"><?php the_title(); ?></h1>
    				</header>
                    <article class="entry-detail">
                        
                        <?php if( has_post_thumbnail() ){ ?>
                            <div class="entry-photo single_doctor_picture">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </div>
                        <?php } ?>
                        <div class="content-text entry-content doctor_full_info clearfix">
							<div class="content_price">
								<span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Fee: </span> <span>&#2547;</span> <?php echo $doctor_fee; ?></span></span>
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
                            <?php
                            wp_link_pages( array(
                                'before'      => '<div class="nav-links"><span class="page-links-title">' . esc_attr__( 'Pages:', 'kutetheme' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                                'pagelink'    => '%',
                                'separator'   => '',
                            ) );
                            ?>
                        </div>
                      
                    </article>
                    
                </div>
                <?php if( $kt_sidebar_are != 'full' ){ ?>
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <div class="sidebar">
                            <?php get_sidebar();?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>