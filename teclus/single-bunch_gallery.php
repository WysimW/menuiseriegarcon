<?php $options = _WSH()->option();
	get_header(); 
	$settings  = teclus_set(teclus_set(get_post_meta(get_the_ID(), 'bunch_page_meta', true) , 'bunch_page_options') , 0);
	$meta = _WSH()->get_meta('_bunch_layout_settings');
	$meta1 = _WSH()->get_meta('_bunch_header_settings');
	$meta2 = _WSH()->get_meta();
	_WSH()->page_settings = $meta;
	if(teclus_set($_GET, 'layout_style')) $layout = teclus_set($_GET, 'layout_style'); else
	$layout = teclus_set( $meta, 'layout', 'full' );
	if( !$layout || $layout == 'full' || teclus_set($_GET, 'layout_style')=='full' ) $sidebar = ''; else
	$sidebar = teclus_set( $meta, 'sidebar', 'blog-sidebar' );
	$classes = ( !$layout || $layout == 'full' || teclus_set($_GET, 'layout_style')=='full' ) ? ' col-lg-12 col-md-12 col-sm-12 col-xs-12 ' : ' col-lg-9 col-md-8 col-sm-12 col-xs-12 ' ;
	/** Update the post views counter */
	_WSH()->post_views( true );
?>

<!--Featured Slider Section-->
<?php while( have_posts() ): the_post(); 
	$gallery_meta = _WSH()->get_meta();
?>
<section class="featured-slider-section">
    <div class="slider-outer">

        <!--Featured Carousel Slider-->
        <div class="featured-carousel">
            <?php if($slider = teclus_set($gallery_meta, 'slider_carousel')):?>
            <!--Slide Item-->
            <?php foreach($slider as $key => $value):?>
            <article class="slide-item" style="background-image:url('<?php echo esc_url(teclus_set($value, 'slide_img'));?>');">
                <div class="slide-caption">
                    <h3 class="caption-title"><sup class="count old-standard-font"><?php echo balanceTags(teclus_set($value, 'num'));?></sup><?php echo balanceTags(teclus_set($value, 'title'));?></h3>
                    <div class="caption-text">
                        <p><?php echo balanceTags(teclus_set($value, 'text'));?></p>
                    </div>
                </div>
            </article>
            <?php endforeach;?>
            <?php endif;?>
            
        </div>
        
    </div>
    
    <div class="auto-container">
        
        <!-- Styled Pagination -->
        <div class="styled-pagination text-center margin-top-50">
            <?php teclus_the_pagination(); ?>
        </div>
        
    </div>
    
</section>
<?php endwhile;?>
<?php get_footer(); ?>