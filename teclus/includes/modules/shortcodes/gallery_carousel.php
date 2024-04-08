<?php  
   $count = 1;
   $query_args = array('post_type' => 'bunch_gallery' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['gallery_category'] = $cat;
   $query = new WP_Query($query_args) ; 
   
   ob_start() ;?>
   
<?php if($query->have_posts()):  ?>   
<!--Gallery Carousel Section-->
    <section class="gallery-carousel-section">
        <div class="carousel-slider five-column">
        	<?php while($query->have_posts()): $query->the_post();
				global $post ; 
				$services_meta = _WSH()->get_meta();
				//teclus_printr($services_meta); exit("sdsds");
			?>
            
            <?php 
				$post_thumbnail_id = get_post_thumbnail_id($post->ID);
				$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			?>
            <!--Image Box-->
            <div class="image-box">
                <div class="inner-box">
                    <figure class="image"><a href="<?php echo esc_url($post_thumbnail_url); ?>" class="lightbox-image"><?php the_post_thumbnail('teclus_270x184');?></a></figure>
                    <a href="<?php echo esc_url($post_thumbnail_url); ?>" class="lightbox-image btn-zoom"><span class="icon flaticon-arrows"></span></a>
                </div>
            </div>
            <?php endwhile;?>
        </div>
    </section>

<?php endif; ?>
<?php 
	wp_reset_postdata();
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>