<?php 
bunch_global_variable();
$paged = get_query_var('paged');
$args = array('post_type' => 'bunch_gallery', 'showposts'=>$num, 'orderby'=>$sort, 'order'=>$order, 'paged'=>$paged);
$terms_array = explode(",",$exclude_cats);
if($exclude_cats) $args['tax_query'] = array(array('taxonomy' => 'gallery_category','field' => 'id','terms' => $terms_array,'operator' => 'NOT IN',));
$query = new WP_Query($args);
//query_posts($args);
//wp_enqueue_script( array( 'jquery-prettyphoto', 'cubeportfolio', 'main-script','jquery-isotope','portfolio' ) );
$t = $GLOBALS['_bunch_base'];
$data_filtration = '';
$data_posts = '';
?>
<?php if( $query->have_posts() ):
	
ob_start();?>
	<?php $count = 0; 
	$fliteration = array();?>
	<?php while( $query->have_posts() ): $query->the_post();
		global  $post;
		//$meta = get_post_meta( get_the_id(), '_bunch_gallery_meta', true );//teclus_printr($meta);
		$meta = _WSH()->get_meta();
		$post_terms = get_the_terms( get_the_id(), 'gallery_category');// teclus_printr($post_terms); exit();
		foreach( (array)$post_terms as $pos_term ) $fliteration[$pos_term->term_id] = $pos_term;
		$temp_category = get_the_term_list(get_the_id(), 'gallery_category', '', ', ');
	?>
		<?php $post_terms = wp_get_post_terms( get_the_id(), 'gallery_category'); 
		$term_slug = '';
		if( $post_terms ) foreach( $post_terms as $p_term ) $term_slug .= $p_term->slug.' ';?>		
		   <?php 
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
		   ?>     
			<!--Portfolio Item-->
            <article class="portfolio-item mix mix_all col-md-4 col-sm-6 col-xs-12 <?php echo esc_attr($term_slug); ?>">
                <div class="inner-box">
                    <figure class="image-box"><a href="<?php echo esc_url($post_thumbnail_url); ?>" class="lightbox-image" title="<?php esc_html_e('Image Caption Here', 'teclus');?>"><?php the_post_thumbnail('teclus_370x220');?></a></figure>
                    <div class="lower-content">
                        <h3><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_title();?></a></h3>
                        <div class="desc"><?php echo balanceTags(teclus_trim(get_the_excerpt(), $text_limit));?></div>
                        <a href="<?php echo esc_url($post_thumbnail_url); ?>" class="lightbox-image zoom-btn" title="<?php esc_html_e('Image Caption Here', 'teclus');?>"><span class="icon flaticon-shapes-5"></span></a>
                    </div>
                </div>
            </article>
<?php endwhile;?>
<?php wp_reset_postdata();
$data_posts = ob_get_contents();
ob_end_clean();
endif; 
ob_start();?>	 
<?php $terms = get_terms(array('gallery_category')); ?>
<!--Filter Section-->
<section class="gallery-section bg-light-grey outside-hidden">
    	<div class="auto-container">
        	<?php if( $terms ): ?>
            <!--Section Title-->
            <div class="sec-title text-center padd-right-70 with-style style-right">
            	<h2><?php echo balanceTags($title);?></h2>
            </div>
            
            
            <!--Filter-->
            <div class="filters text-center">
            	<ul class="filter-tabs filter-btns clearfix anim-3-all">
                	<li class="filter" data-role="button" data-filter="all"><?php esc_html_e('all', 'teclus');?></li>
    				<?php foreach( $fliteration as $t ): ?>
    				<li class="filter" data-role="button" data-filter=".<?php echo esc_attr(teclus_set( $t, 'slug' )); ?>"><?php echo balanceTags(teclus_set( $t, 'name')); ?></li>
    				<?php endforeach;?>
                </ul>
            </div>
            <?php endif;?>
        </div>
        
        <div class="auto-container images-container">
            <div class="filter-list row clearfix">
                <!--Portfolio Item-->
                <?php echo balanceTags($data_posts); ?>
            </div>
            
            <!-- Styled Pagination -->
            <div class="styled-pagination text-center">
                <?php teclus_the_pagination(array('total'=>$query->max_num_pages, 'next_text' => '<i class="fa fa-angle-double-right"></i>', 'prev_text' => '<i class="fa fa-angle-double-left"></i>')); ?>
            </div>
        </div>
    </section>
<?php $output = ob_get_contents();
ob_end_clean(); 
return $output;?>