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
	$bg = teclus_set($meta1, 'header_img');
	$title = teclus_set($meta1, 'header_title');
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
            
			<!-- Left Content -->
            <div class="<?php echo esc_attr($classes);?>">
				<section class="blog-container blog-detail">
				
				<?php while( have_posts() ): the_post();
					global $post; 
					$post_meta = _WSH()->get_meta();
				?>
                	<div class="blog-detail">
        				<!--Blog Post-->
                        <article class="blog-post">
                            <div class="post-inner">
                                
                                <?php if ( has_post_thumbnail() ):?>
                                <?php 
									$post_thumbnail_id = get_post_thumbnail_id($post->ID);
									$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
								?>
								<div class="image-box">
                                    <figure><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_post_thumbnail('teclus_870x326', 'teclus');?></a></figure>
                                    <div class="overlay-box">
                                        <div class="links-outer">
                                            <a href="<?php echo esc_url($post_thumbnail_url); ?>" class="view lightbox-image"><span class="fa fa-eye"></span></a>
                                            <a href="#" class="add-fav"><span class="fa fa-heart-o"></span></a>
                                            <a href="<?php echo esc_url(get_permalink(get_the_id()));?>" class="read"><span class="fa fa-link"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <?php endif;?>
                                <div class="post-header">
                                    <h2><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_title();?></a></h2>
                                    <ul class="post-info">
                                        <li><span class="fa fa-clock-o"></span>&ensp; <?php echo get_the_date('d M, Y');?></li>
                                        <li><span class="fa fa-user"></span>&ensp; <?php esc_html_e('Posted by', 'teclus');?><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php the_author();?></a></li>
                                        <li><span class="fa fa-server"></span>&ensp; <?php the_category();?></li>
                                    </ul>
                                </div>
                                
                                <div class="post-desc">
                                    <div class="text">
                                    	<?php the_content();?>
                                    </div>
                                    
                                </div>
                            </div>
                        </article>
                    </div>
                    
                    <!-- comment area -->
		            <?php wp_link_pages(array('before'=>'<div class="paginate-links">'.esc_html__('Pages: ', 'teclus'), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>
					<?php comments_template(); ?><!-- end comments -->
				<?php endwhile;?>
                
			</section>
            </div>
            
			<!-- sidebar area -->
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