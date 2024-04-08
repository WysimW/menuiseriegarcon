<?php bunch_global_variable(); //teclus_printr($wp_query); 
	$options = _WSH()->option();
	get_header(); 
	$settings  = _WSH()->option();
	if(teclus_set($_GET, 'layout_style')) $layout = teclus_set($_GET, 'layout_style'); else
	$layout = teclus_set( $settings, 'archive_page_layout', 'right' );
	if( !$layout || $layout == 'full' || teclus_set($_GET, 'layout_style')=='full' ) $sidebar = ''; else
	$sidebar = teclus_set( $settings, 'archive_page_sidebar', 'blog-sidebar' );
	_WSH()->page_settings = array('layout'=>$layout, 'sidebar'=>$sidebar);
	$classes = ( !$layout || $layout == 'full' || teclus_set($_GET, 'layout_style')=='full' ) ? ' col-lg-12 col-md-12 col-sm-12 col-xs-12 ' : ' col-lg-9 col-md-8 col-sm-12 col-xs-12 ' ;
	$bg = teclus_set($settings, 'archive_page_header_img');
	$title = teclus_set($settings, 'archive_page_header_title');
?>
<!--Page Title-->
<section class="page-title" <?php if($bg):?>style="background-image:url('<?php echo esc_attr($bg)?>');"<?php endif;?>>
    <div class="auto-container">
        <div class="sec-title">
            <h1><?php if($title) echo balanceTags($title); else wp_title('');?></h1>
            <div class="bread-crumb"><?php echo balanceTags(teclus_get_the_breadcrumb()); ?></div>
        </div>
    </div>
</section>

<!--Sidebar Page-->
<div class="sidebar-page">
    <div class="auto-container">
        <div class="row clearfix">
		<!-- sidebar area -->
			<?php if( $layout == 'left' ): ?>
			<?php if ( is_active_sidebar( $sidebar ) ) { ?>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">       
				<aside class="sidebar">
					<?php dynamic_sidebar( $sidebar ); ?>
				</aside>
			</div>
			<?php }?>
			<?php endif; ?>
			<!-- sidebar area -->
            
            <div class="<?php echo esc_attr($classes);?>">
                <section class="blog-container">
                            
                    <?php while( have_posts() ): the_post();?>
                            <!-- blog post item -->
                            <!-- Post -->
                            <div id="post-<?php the_ID(); ?>" <?php post_class();?>>
                                <?php get_template_part( 'blog' ); ?>
                            <!-- blog post item -->
                            </div><!-- End Post -->
                    <?php endwhile;?> 
                    
                    <!-- Styled Pagination -->
                    <div class="styled-pagination text-center margin-top-50">
                        <?php teclus_the_pagination(); ?>
                    </div>
                    
                </section>
            </div>
            
			<?php if( $layout == 'right' ): ?>
			<?php if ( is_active_sidebar( $sidebar ) ) { ?>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">       
				<aside class="sidebar">
					<?php dynamic_sidebar( $sidebar ); ?>
				</aside>
			</div>
			<?php }?>
			<?php endif; ?>
			<!-- sidebar area -->
		</div>
	</div>
</div>
<?php get_footer(); ?>