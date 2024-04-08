<?php  
   $count = 1;
   $query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['services_category'] = $cat;
   $query = new WP_Query($query_args) ; 
   
   ob_start() ;?>
   
<?php if($query->have_posts()):  ?>   
	
    <!--Services Column-->
    <div class="column services-column no-padd-left">
        <div class="inner-box padd-top-50 padd-bott-30">
            
            <!--Text Carousel-->
            <div class="text-carousel">
                <?php while($query->have_posts()): $query->the_post();
					global $post ; 
					$services_meta = _WSH()->get_meta();
					//teclus_printr($services_meta); exit("sdsds");
                ?>
                <!--Slide Item-->
                <div class="slide-item">
                    <h4><?php the_title(); ?></h4>
                    <div class="text"><?php echo balanceTags(teclus_trim(get_the_excerpt(), $text_limit));?></div>
                </div>
                <?php endwhile;?>
            </div> <!--End Text Carousel-->
            
        </div>
        <!--Image-->
        <figure class="image wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="<?php echo esc_url(wp_get_attachment_url( $image, 'full' )); ?>"></figure>
        
    </div>
<?php endif; ?>
<?php 
	wp_reset_postdata();
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>