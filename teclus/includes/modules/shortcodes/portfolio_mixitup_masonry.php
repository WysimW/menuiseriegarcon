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
		    <!--Masonry Item-->
            <article class="masonry-item all <?php echo esc_attr($term_slug); ?> <?php if(teclus_set($meta, 'extra_width') == 'extra_width') echo 'two-fifth'; else echo 'one-fifth'?>">
                <div class="inner-box">
                    <figure class="image-box"><a class="lightbox-image" href="<?php echo esc_url($post_thumbnail_url); ?>" title="<?php esc_html_e('Caption Of Image', 'teclus');?>">
                    	<?php if(teclus_set($meta, 'extra_width') == 'extra_width') 
								$image_size = 'teclus_468x468'; 
							  elseif(teclus_set($meta, 'extra_height') == 'extra_height')
								$image_size = 'teclus_468x234'; 
							  else
								$image_size = 'teclus_234x234'; 
							  
							  the_post_thumbnail($image_size);
						?></a>
                    </figure>
                    <div class="overlay-box">
                        <h4><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_title(); ?></a></h4>
                        <div class="desc"><?php echo balanceTags(teclus_trim(get_the_excerpt(), $text_limit)); ?></div>
                        <a href="<?php echo esc_url($post_thumbnail_url); ?>" class="zoom-btn lightbox-image"><span class="icon flaticon-cross-1"></span></a>
                    </div>
                </div>
            </article>
            
<?php $count++; endwhile;?>
<?php wp_reset_postdata();
$data_posts = ob_get_contents();
ob_end_clean();
endif; 
ob_start();?>	 
<?php $terms = get_terms(array('gallery_category')); ?>
<!--Gallery Section-->
<section class="gallery-section bg-light-grey outside-hidden sortable-masonry">
    <div class="auto-container">
        <?php if( $terms ): ?>
        <!--Section Title-->
        <div class="sec-title text-center padd-right-70 with-style style-right">
            <h2><?php echo balanceTags($title);?></h2>
        </div>
        <!--Filter-->
        <div class="filters text-center">
            <ul class="filter-tabs filter-btns clearfix anim-3-all">
                <li class="<?php if($count == 1) echo 'active'?> filter" data-role="button" data-filter=".all"><?php esc_html_e('all', 'teclus');?></li>
                <?php foreach( $fliteration as $t ): ?>
                <li class="filter" data-role="button" data-filter=".<?php echo esc_attr(teclus_set( $t, 'slug' )); ?>"><?php echo balanceTags(teclus_set( $t, 'name')); ?></li>
                <?php endforeach;?>
            </ul>
        </div>
        <?php endif;?>
    </div>
    
    <div class="images-container">
        
        <div class="items-container clearfix">
            <?php echo balanceTags($data_posts); ?>
        </div>
        
        <!-- Styled Pagination -->
        <div class="styled-pagination text-center margin-top-50">
        	<?php teclus_the_pagination(array('total'=>$query->max_num_pages, 'next_text' => '<i class="fa fa-angle-double-right"></i>', 'prev_text' => '<i class="fa fa-angle-double-left"></i>')); ?>
        </div>
        
    </div>
    
</section>

<?php $output = ob_get_contents();
ob_end_clean(); 
return $output;?>