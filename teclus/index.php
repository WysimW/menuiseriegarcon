<?php bunch_global_variable(); 
	$options = _WSH()->option();
	get_header(); 
	if( $wp_query->is_posts_page ) {
		$meta = _WSH()->get_meta('_bunch_layout_settings', get_queried_object()->ID);
		$meta1 = _WSH()->get_meta('_bunch_header_settings', get_queried_object()->ID);
		if(teclus_set($_GET, 'layout_style')) $layout = teclus_set($_GET, 'layout_style'); else
		$layout = teclus_set( $meta, 'layout', 'right' );
		$sidebar = teclus_set( $meta, 'sidebar', 'default-sidebar' );
		$view = teclus_set( $meta, 'view', 'grid' );
		$bg = teclus_set($meta1, 'header_img');
		$title = teclus_set($meta1, 'header_title');
	} else {
		$settings  = _WSH()->option(); 
		if(teclus_set($_GET, 'layout_style')) $layout = teclus_set($_GET, 'layout_style'); else
		$layout = teclus_set( $settings, 'archive_page_layout', 'right' );
		$sidebar = teclus_set( $settings, 'archive_page_sidebar', 'default-sidebar' );
		$view = teclus_set( $settings, 'archive_page_view', 'list' );
		$bg = teclus_set($settings, 'archive_page_header_img');
		$title = teclus_set($settings, 'archive_page_header_title');
	}
	$layout = teclus_set( $_GET, 'layout' ) ? teclus_set( $_GET, 'layout' ) : $layout;
	$view = teclus_set( $_GET, 'view' ) ? teclus_set( $_GET, 'view' ) : $view;
	$sidebar = ( $sidebar ) ? $sidebar : 'default-sidebar';
	_WSH()->page_settings = array('layout'=>'right', 'sidebar'=>$sidebar);
	$classes = ( !$layout || $layout == 'full' || teclus_set($_GET, 'layout_style')=='full' ) ? ' col-lg-12 col-md-12 col-sm-12 col-xs-12 ' : ' col-lg-9 col-md-8 col-sm-12 col-xs-12 ' ;
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
    
	<!-- Sidebar Page -->
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