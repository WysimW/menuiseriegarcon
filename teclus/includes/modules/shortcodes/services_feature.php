<?php  
   $count = 1;
   $query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['services_category'] = $cat;
   $query = new WP_Query($query_args) ; 
   
   ob_start() ;?>
   
<?php if($query->have_posts()):  ?>   
	
    <!--Featured Slider Section-->
    <section class="featured-slider-section">
    	<div class="slider-outer">
        	<!--Featured Carousel Slider-->
            <div class="featured-carousel">
            	<?php while($query->have_posts()): $query->the_post();
					global $post ; 
					$services_meta = _WSH()->get_meta();
					//teclus_printr($services_meta); exit("sdsds");
                ?>
                <!--Slide Item-->
                <article class="slide-item" style="background-image:url(<?php echo esc_url(teclus_set($services_meta, 'bg_img')); ?>);">
                	<div class="slide-caption">
                    	<h3 class="caption-title"><sup class="count old-standard-font"><?php echo balanceTags(teclus_set($services_meta, 'number')); ?></sup><?php the_title();?></h3>
                        <div class="caption-text">
                        	<p><?php echo balanceTags(teclus_trim(get_the_excerpt(), $text_limit));?></p>
                        </div>
                    </div>
                </article>
                
                <?php endwhile;?>
            </div>
        </div>
    </section>

<?php endif; ?>
<?php 
	wp_reset_postdata();
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>