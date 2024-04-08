<?php /* Template Name: VC Page */

	get_header() ;

	$meta = _WSH()->get_meta('_bunch_header_settings');

	$bg = teclus_set($meta, 'header_img');

	$title = teclus_set($meta, 'header_title');

?>

<?php if(teclus_set($meta, 'breadcrumb')):?>

	<!-- Page Banner -->
	<!--Page Title-->
    <section class="page-title" <?php if($bg):?>style="background-image:url('<?php echo esc_attr($bg)?>');"<?php endif;?>>
    	<div class="auto-container">
        	<div class="sec-title">
                <h1><?php if($title) echo balanceTags($title); else wp_title('');?></h1>
                <div class="bread-crumb"><?php echo balanceTags(teclus_get_the_breadcrumb()); ?></div>
            </div>
        </div>
    </section>

<?php endif;?>

<?php while( have_posts() ): the_post(); ?>

    <?php the_content(); ?>

<?php endwhile;  ?>


<?php get_footer() ; ?>